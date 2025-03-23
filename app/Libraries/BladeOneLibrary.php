<?php

namespace App\Libraries;

use eftec\bladeone\BladeOne;

class BladeOneLibrary
{
    protected $blade;

    public function __construct()
    {
        $views = APPPATH . 'Views';
        $cache = WRITEPATH . 'cache';

        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

        // Direktif kustom @error seperti di Laravel
        $this->blade->directive('error', function ($field) {
            return "<?php if (isset(session('errors')[$field])): ?>";
        });

        $this->blade->directive('enderror', function () {
            return "<?php endif; ?>";
        });
    }

    public function render($template, $data = [])
    {
        return $this->blade->run($template, $data);
    }
}