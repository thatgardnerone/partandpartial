<?php

use function Pest\Laravel\get;

it('shows the page', function () {
   get(route('lazy-cards'))->assertOk();
});
