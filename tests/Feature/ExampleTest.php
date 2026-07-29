<?php

it('returns a successful response for login route', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});
