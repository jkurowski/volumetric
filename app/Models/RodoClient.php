<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RodoClient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rodo_clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mail',
        'ip',
        'timestamp',
        'host',
        'browser'
    ];

    public function saveOrCreate($request)
    {
        $user = self::where('mail', '=', $request->form_email)->first();

        if($user === null) {
            self::create([
                'name' => $request->form_name,
                'mail'  => $request->form_email,
                'ip' => $request->ip(),
                'timestamp' => time(),
                'host' => gethostbyaddr($request->ip()),
                'browser' => $_SERVER['HTTP_USER_AGENT']
            ]);
        } else {
            $user->name = $request->form_name;
            $user->ip = $request->ip();
            $user->host = gethostbyaddr($request->ip());
            $user->browser = $_SERVER['HTTP_USER_AGENT'];
            $user->timestamp = time();
            $user->save();
        }
    }
}
