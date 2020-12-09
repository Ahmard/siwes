<?php

namespace App\Helpers;

use App;
use App\Helpers\Core\AlertFactory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use JetBrains\PhpStorm\Pure;

class Alert
{
    public string $flashMethod;

    protected bool $willExecNow = false;


    public function __call(string $methodName, array $args): static
    {
        if (str_contains($methodName, 'Now')) {
            $methodName = explode('Now', $methodName)[0];
            //indicate we are performing the action now
            $this->willExecNow = true;

            return $this->$methodName(...$args);
        }

        throw new Exception("Method " . __CLASS__ . "::{$methodName}() not found");
    }

    #[Pure] public static function create(): self
    {
        return new self();
    }

    /**
     * Get handler instance
     *
     */
    public function getHandlerInstance(): AlertFactory
    {
        return App::make('siwes.resp.handler');
    }

    public function redirect(?string $url = null): Redirector|Application|RedirectResponse
    {
        return redirect($url);
    }

    public function flash($method, $type, $msg): static
    {
        $this->getHandlerInstance()->flash($method, $type, $msg, $this->willExecNow);
        $this->willExecNow = false;
        return $this;
    }


    /**
     * Entry methods
     * @param string|null $type
     * @param mixed|null $msg
     * @return Alert
     */
    public function alert(string $type = null, string $msg = null): static
    {
        $this->flashMethod = 'alert';
        if ($type != null) {
            $this->flash($this->flashMethod, $type, $msg);
        }

        return $this;
    }


    public function toast(string $type = null, string $msg = null): self
    {
        $this->flashMethod = 'toast';
        if ($type != null) {
            $this->flash($this->flashMethod, $type, $msg);
        }

        return $this;
    }


    public function command(string $type = null, string $msg = null): static
    {
        $this->flashMethod = 'command';
        if ($type != null) {
            $this->flash($this->flashMethod, $type, $msg);
        }

        return $this;
    }


    public function info(string $message): static
    {
        $this->flash($this->flashMethod, 'info', $message);
        return $this;
    }


    public function warning(string $message): static
    {
        $this->flash($this->flashMethod, 'warning', $message);
        return $this;
    }


    public function success(string $message): static
    {
        $this->flash($this->flashMethod, 'success', $message);
        return $this;
    }


    public function danger(string $message): static
    {
        return $this->error($message);
    }


    public function error(string $message): static
    {
        $this->flash($this->flashMethod, 'danger', $message);
        return $this;
    }


    public function getAlerts(): array
    {
        return $this->getHandlerInstance()->getFlashed('alert');
    }


    public function getToasts(): array
    {
        return $this->getHandlerInstance()->getFlashed('toast');
    }


    public function getCommands(): array
    {
        return $this->getHandlerInstance()->getFlashed('command');
    }
}
