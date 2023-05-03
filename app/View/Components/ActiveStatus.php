<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActiveStatus extends Component
{

    public bool $isActive = false;
    public string $onMessage = '';
    public string $offMessage = '';
    public string $onType = '';
    public string $offType = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        bool $activeStatus,
        string $onMessage='Active',
        string $offMessage='Deactive',
        string $onType='success',
        string $offType='danger'
    )
    {
        $this->isActive = $activeStatus;
        $this->onMessage = $onMessage;
        $this->offMessage = $offMessage;
        $this->onType = $onType;
        $this->offType = $offType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.active-status');
    }
}
