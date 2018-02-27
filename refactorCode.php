<?php
/**
 * Created by PhpStorm.
 * User: zhangyupeng
 * Date: 18/2/27
 * Time: 17:49
 */
class refactorCode
{
    public function getDmpIdentificationInfo()
    {
        $res = $this->Dmp_basic_model->getDmpIdentificationlist();
        $dmpSingleIdentification = [];
        $dmpIdentification = [];
        // 老式 代码方式
        foreach ($res as $item) {
            if ($item['single'] == 1) {
                $ext = implode('', explode('_', $item['dmp_identification']));
                $dmpSingleIdentification[$item['id']] = [
                    'id' => $item['id'],
                    'identification' => [$ext],
                ];
            } else {
                $dmpIdentification[$item['id']] = [
                    'id' => $item['id'],
                    'identification' => $item['dmp_identification'],
                ];
            }

        }

        foreach ($dmpIdentification as $k=>$dmp) {
            $identification = explode(',', $dmp['identification']);
            $arr = [];
            if ($k == 1038 ) {
                array_pop($identification);
                foreach ($identification as $value) {
                    $ex = $dmpSingleIdentification[$value]['identification'][0];
                    $arr[] = $ex;
                }
            }else {
                foreach ($identification as $value) {
                    $ex = $dmpSingleIdentification[$value]['identification'][0];
                    $arr[] = $ex;
                }
            }
            $dmpIdentification[$k]['identification'] = $arr;
        }
        $dmpIdentification = array_merge($dmpSingleIdentification, $dmpIdentification);
        $dmpIdentificationArr = [];
        foreach ($dmpIdentification as $item) {
            $dmpIdentificationArr[$item['id']] = $item;
        }
        return $dmpIdentificationArr;
    }

    // 测试代码
    public function test()
    {
        $arr = [
            [
                "single" => 1,
                "dmp_identification" => 'd_yw',
            ],
            [
                "single" => 1,
                "dmp_identification" => 'd_td',
            ],
            [
                "single" => 0,
                "dmp_identification" => 'd_m,d_td',
            ],
            [
                "single" => 1,
                "dmp_identification" => 'd_m',
            ],

        ];

        $res = $this->getSinglDmpIdentification($arr);
        var_dump($res);
    }

    // 优化方式
    private function getSinglDmpIdentification(array $dmpArr)
    {
        return array_map(function($item){
            return ['single' => $item['single'], 'dmp_identification' => implode('', explode('_', $item['dmp_identification']))];
        }, array_filter($dmpArr, function($item) {
            return $item['single'] == 1 ? true : false;

        }));
    }
}

$a = new refactorCode();
$a->test();