<?php
namespace App\Http\Helpers;

use Illuminate\Support\Facades\Storage;

class WebpHelper {

	public static function convertToWebp($destination, $path) {
		$image = imagecreatefromstring(file_get_contents(storage_path() . '/app/public/' . $destination . $path));
		ob_start();
		imagejpeg($image, NULL, 100);
		$cont = ob_get_contents();
		ob_end_clean();
		imagedestroy($image);
		$content = imagecreatefromstring($cont);
		$output = storage_path() . '/app/public/' . $destination . $path . '.webp';
		imagewebp($content, $output);
		imagedestroy($content);
	}

}