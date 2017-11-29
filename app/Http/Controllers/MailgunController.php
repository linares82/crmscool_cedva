<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class MailgunController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function webhooks(Request $request)
	{
		app('log')->debug(request()->all());

        $files = collect(json_decode($request->input('attachments'), true))
        ->filter(function ($file) {
            return $file['content-type'] == 'text/csv';
        });

        if ($files->count() === 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Missing expected CSV attachment'
            ], 406);
        }

        dispatch(new ProcessWidgetFiles($files));

        return response()->json(['status' => 'ok'], 200);
	}

}
