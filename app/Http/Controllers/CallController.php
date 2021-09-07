<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Call;
use App\Models\User;
use App\Http\Controllers\Auth;
use App\Http\Controllers\UsuarioController;

class CallController extends Controller
{

    public function index() {
        $calls = Call::all();
        $usuariosOnline = $this->buscaUsuarioOnline();

        return view('calls', ['calls' => $calls, 'usuariosOnline' => $usuariosOnline]);
    }

    public function buscaUsuarioOnline() {
        $usuariosOnline = User::where('status', 'Online')->get();

        return $usuariosOnline;
    }

    public function destroy($id) {
        Call::findOrFail($id)->delete();

        return redirect('/calls')->with('msg', 'Excluido com sucesso!');
    }

    public function create(Request $request) {
        $calls = new Call();
    	$data = $request->all();
        $verificaSeExiste = Call::where('call_sid', $data["call_sid"])->first();

        if (!empty($verificaSeExiste)) {
            $calls = Call::find($verificaSeExiste["id"]);
            $calls->call_sid = $data["call_sid"];
            $calls->status = $data['status'];
            $calls->from_user = $data["from_user"];
            $calls->to_user = $data['to_user'];
            $calls->duration = $data['duration'];
            $calls->save();
        } else {
            $calls->call_sid = $data["call_sid"];
            $calls->status = $data['status'];
            $calls->from_user = $data["from_user"];
            $calls->to_user = $data['to_user'];
            $calls->duration = $data['duration'];
            $calls->save();
        }

		return response()->json([
			"msg" => 'done',
		]);
    }

}
