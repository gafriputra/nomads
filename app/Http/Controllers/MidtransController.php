<?php

namespace App\Http\Controllers;

// email sukses
use App\Mail\TransactionSuccess;
// model  transaksi
use App\Transaction;
use Illuminate\Http\Request;
// untuk kirim email
use Illuminate\Support\Facades\Mail;
// midtrans
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // set konfigurasi midtrans
        // set konnfigrasi midtrans ngambil dari config/midrtrans.php
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // buat intance midtrans nontification
        $notification = New Notification();
        $order_id = explode('-',$notification->order_id);
        // Assign ke variabel untuk memudahkan config
        $status= $notification->transaction_status;
        $type= $notification->payment_type;
        $froud= $notification->fraud_status;
        $order_id= $order_id[1];

        // Cari transaksi berdasarkanID
        $transaction = Transaction::findOrFail($order_id);

        // handle nontification midtrans
        if ($status == "capture") {
            if ($type == "credit_card") {
                if ($froud == "challenge") {
                    $transaction->transaction_status = "CHALLENGE";
                }else {
                    $transaction->transaction_status = "SUCCESS";

                }
            }
        }
        elseif ($status == "settlement") {
            $transaction->transaction_status = "SUCCESS";
        }
        elseif ($status == "pending") {
            $transaction->transaction_status = "PENDING";
        }
        elseif ($status == "deny") {
            $transaction->transaction_status = "FAILED";
        }
        elseif ($status == "expire") {
            $transaction->transaction_status = "EXPIRED";
        }
        elseif ($status == "cancel") {
            $transaction->transaction_status = "FAILED";
        }

        // simpan transaksi
        $transaction->save();

        // kirim email

        if ($transaction) {
            if ($status=="capture" && $froud=="accept") {
                // kirim email ke usernya
                // email ditulis ->email boleh, gak ditulis boleh, karena sudah otomatis mencari kolom email ditabel
                // dikirim ke sini isi variabelnya
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            }
            elseif ($status=="settlement") {
                // kirim email ke usernya
                // email ditulis ->email boleh, gak ditulis boleh, karena sudah otomatis mencari kolom email ditabel
                // dikirim ke sini isi variabelnya
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            }
            elseif ($status=="success") {
                // kirim email ke usernya
                // email ditulis ->email boleh, gak ditulis boleh, karena sudah otomatis mencari kolom email ditabel
                // dikirim ke sini isi variabelnya
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            }
            // kasih respon ke midtrans
            elseif ($status=="capture" && $froud=="challenge") {
                return response()->json([
                    "meta" => [
                        'code' =>200,
                        'message' => "Midtrans Payment Challenge"
                    ]
                ]);
            }
            // kasih respon ke midtrans
            else {
                return response()->json([
                    "meta" => [
                        'code' =>200,
                        'message' => "Midtrans Payment Not Settlement"
                    ]
                ]);
            }
        }
        else {
            return response()->json([
                "meta" => [
                    'code' =>200,
                    'message' => "Midtrans Nontification Success"
                ]
            ]);
        }

    }

    public function finishRedirect(Request $request)
    {
        return view('pages.success');
    }

    public function unfinishRedirect(Request $request)
    {
        return view('pages.unfinish');
    }

    public function errorRedirect(Request $request)
    {
        return view('pages.failed');
    }
}
