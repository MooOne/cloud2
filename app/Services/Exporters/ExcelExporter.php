<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-10
 * Time: 上午11:30.
 */

namespace Yeelight\Services\Exporters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ExcelExporter
 *
 * @category Yeelight
 *
 * @package Yeelight\Services\Exporters
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class ExcelExporter extends AbstractExporter
{
    /**
     * {@inheritdoc}
     */
    public function export()
    {
        Excel::create($this->getTable().date('YmdHis'), function ($excel) {
            $excel->sheet($this->getTable(), function ($sheet) {
                $titles = [];

                $this->chunk(function ($records) use ($sheet, &$titles) {
                    if (empty($titles)) {
                        $titles = $this->getHeaderRowFromRecords($records);
                        $sheet->prependRow($titles);
                    }
                    $rows = collect($records->toArray())->map(function ($item) {
                        $return = [];
                        foreach ($item as $in => $it) {
                            if (is_array($it)) {
                                $return[$in] = Arr::isAssoc($it) ? implode(',', $it) : json_encode($it);
                            } else {
                                $return[$in] = $it;
                            }
                        }

                        return $return;
                    });
                    $sheet->rows($rows);
                });
            });
        })->export('xlsx');
    }

    /**
     * @param Collection $records
     *
     * @return array
     */
    public function getHeaderRowFromRecords(Collection $records): array
    {
        $titles = collect(array_dot($records->first()->toArray()))->keys()->map(
            function ($key) {
                $key = str_replace('.', ' ', $key);

                return Str::ucfirst($key);
            }
        );

        return $titles->toArray();
    }

    /**
     * @param Model $record
     *
     * @return array
     */
    public function getFormattedRecord(Model $record)
    {
        return array_dot($record->getAttributes());
    }
}
