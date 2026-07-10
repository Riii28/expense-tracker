<?php

use Illuminate\Http\UploadedFile;

test('upload image to the upload controller', function () {
    $image = UploadedFile::fake()->image('irvan.png');

    $this->post('/upload', ['picture' => $image])->assertSeeText('OK: irvan.png');
});
