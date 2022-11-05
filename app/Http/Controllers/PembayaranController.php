<?php

    namespace App\Http\Controllers;

    use App\Pembayaran;
    use Illuminate\Http\Request;
    use Yajra\DataTables\DataTables;
    use Mike42\Escpos\Printer; 
    use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
    use Mike42\Escpos\PrintConnectors\FilePrintConnector;
    use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

    class PembayaranController extends Controller
    {
        public function print(Request $request)
        {
            try {
                $connector = new WindowsPrintConnector("epson U220");
                $printer = new Escpos($connector);
                $printer -> text("Hello World!\n");
                $printer -> cut();

                $printer -> close();
            } catch(Exception $e) {
                echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
            }
        }
    }