<?php

namespace App\Observers;

use App\Models\RodoClient;
use App\Models\RodoClientRules;
use App\Models\RodoRules;
use Illuminate\Http\Request;

class RodoClientObserver
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function created(RodoClient $rodoClient)
    {

        $checkboxes = preg_grep("/rule_([0-9])/i", array_keys($this->request->all()));

        foreach($checkboxes as $rule) {

            // Wyciągamy numer regułki
            $getId = preg_replace('/[^0-9]/', '', $rule);

            // Pobieramy regułkę
            $rodo = RodoRules::where('id', $getId)->first();

            // Zapisujemy regułkę do bazy
            RodoClientRules::create([
                'rodo_rule_id' => $getId,
                'rodo_client_id' => $rodoClient->id,
                'ip' => $this->request->ip(),
                'url' => $this->request->headers->get('referer'),
                'duration' => strtotime("+".$rodo->time." months", strtotime(date("y-m-d"))),
                'months' => $rodo->time,
                'status' => 1
            ]);
        }
    }

    public function updated(RodoClient $rodoClient)
    {
        RodoClientRules::where('rodo_client_id', $rodoClient->id)->where('status', '=', 1)->update(['status' => 2, 'canceled_at' => now()]);

        $checkboxes = preg_grep("/rule_([0-9])/i", array_keys($this->request->all()));

        foreach($checkboxes as $rule) {

            // Wyciągamy numer regułki
            $getId = preg_replace('/[^0-9]/', '', $rule);

            // Pobieramy regułkę
            $rodo = RodoRules::where('id', $getId)->first();

            // Zapisujemy regułkę do bazy
            RodoClientRules::create([
                'rodo_rule_id' => $getId,
                'rodo_client_id' => $rodoClient->id,
                'ip' => $this->request->ip(),
                'url' => $this->request->headers->get('referer'),
                'duration' => strtotime("+".$rodo->time." months", strtotime(date("y-m-d"))),
                'months' => $rodo->time,
                'status' => 1
            ]);
        }
    }

}
