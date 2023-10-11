<?php
use App\Http\Controllers\Controller;
use App\Models\UserInfos;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
public function verify($code)
{
$user = UserInfos::where('confirmation_code', $code)->first();

if ($user) {
$user->markEmailAsVerified();
// Redirigez l'utilisateur vers la page de confirmation réussie ou une autre page
} else {
// Redirigez l'utilisateur vers la page d'erreur de confirmation
}
}
}
