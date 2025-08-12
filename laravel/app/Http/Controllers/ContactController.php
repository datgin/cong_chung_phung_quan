<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Traits\DataTables;
use App\Traits\QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    use QueryBuilder;
    use DataTables;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->queryBuilder(
                model: new Contact,
            );

            return $this->processDataTable(
                $query,
                fn($dataTable) =>

                $dataTable->editColumn('id', fn($row) => $row->id . ' | <small>' . $row->created_at->format('d/m/Y') . '</small>'),
                ['id']
            );
        }
        return view('pages.contacts.index');
    }

    public function updateMailContact(Request $request)
    {

        return transaction(function () use ($request) {
            $key = 'MAIL_CONTACT_RECEIVER';

            if (! $value = $request->input($key)) {
                return errorResponse("Email không hợp lệ", Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $this->setEnvValue($key, $value);

            Artisan::call('config:clear');

            return successResponse(message: "Cập nhật thành công.", isToastr: false);
        });
    }

    private function setEnvValue($key, $value)
    {
        $path = base_path('.env');
        $escaped = preg_quote("{$key}=", '/');

        if (file_exists($path)) {
            file_put_contents(
                $path,
                preg_replace(
                    "/^{$escaped}.*/m",
                    "{$key}={$value}",
                    file_get_contents($path)
                )
            );
        }
    }
}
