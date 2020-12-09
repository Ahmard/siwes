<?php

namespace App\Helpers\Core;

class AlertFactory
{
    protected string $key = 'app-msg';

    protected array $legacyFlashes = array(
        'msg:error', 'msg:warning', 'msg:warn',
        'msg:info', 'msg:success',
        'error', 'warning', 'info', 'success'
    );

    protected string $method;

    protected array $flashes = [];

    protected array $flashNow = [];

    /**
     * Set flash method
     * @param string $method like alert,toast
     * @return void
     */
    public function setFlashMethod(string $method)
    {
        $this->method = $method;
    }


    /**
     * Send flash of alert or toast
     * @param string $method
     * @param string $type like success,error
     * @param string $msg like hello world
     * @param bool $willExecNow
     * @return bool
     */
    public function flash(
        string $method,
        string $type,
        string $msg,
        bool $willExecNow = false
    ): bool
    {
        if ($willExecNow) {
            $this->flashNow ??= [$method => []];
            $this->flashNow[$method][] = [
                'type' => $type,
                'msg' => $msg,
            ];
            return true;
        }

        $this->flashes ??= [$method => []];
        $this->flashes[$method][] = [
            'type' => $type,
            'msg' => $msg,
        ];

        return true;
    }


    /**
     * Set flashes
     * @return void
     */
    public function pushFlashes(): void
    {
        session()->flash($this->key, $this->flashes);
    }


    /**
     * Retrieve flashed data
     * @param string $method
     * @return array
     */
    public function getFlashed(string $method): array
    {
        $flashedData = session()->get($this->key);
        $methodData = $flashedData[$method] ?? [];
        //lets merge them with flashNow flashes
        $methodData = array_merge(
            $methodData,
            $this->flashNow[$method] ?? []
        );

        //Remove alerts
        unset($flashedData[$method]);

        session()->forget($this->key);
        session()->flash($this->key, $flashedData);

        //Support legacy flashes
        if ($method == 'alert') {
            $legacyFlashes = session()->only($this->legacyFlashes);
            foreach ($legacyFlashes as $flashedName => $flashedValue) {
                if (strpos($flashedName, ':')) {
                    $flashedName = explode(':', $flashedName)[1];
                }
                $methodData[] = [
                    'type' => $flashedName,
                    'msg' => $flashedValue
                ];
            }
        }

        return $methodData;
    }
}
