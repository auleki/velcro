<?php

namespace App\Services;

use App\ReceivedReport;
use App\User;

	
	class Report
	{
		public static function newSubmissions() {
      $user_id = auth()->user()->id;

      $new_submissions = ReceivedReport::where('user_id', $user_id)
        ->where('status', 'new')
        ->get();

      if (count($new_submissions) > 0) {
        return true;
      }

      return false;
    }
	}
?>
