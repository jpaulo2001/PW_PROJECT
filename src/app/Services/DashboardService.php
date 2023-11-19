<?php




namespace App\Services;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;
use App\Models\Document;
use App\Models\DocumentMetadata;

class DashboardService
{
    protected function getLastSevenDocuments(Document $Document, ?Carbon $date = null)
    {
        if ($date == null) {
            $date = Carbon::now();
        }

        return DocumentMetadata::query()
            ->where('documents_id', $document->id)
            ->where('created_at', '>=', $date = Carbon::now()->subDays(7))
            ->orderBy('created_at')
            ->get();
    }
}

