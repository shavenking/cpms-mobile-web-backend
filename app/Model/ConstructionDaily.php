<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ConstructionDaily extends Model
{
    protected $fillable = [
        'weather_morning', // 上午天氣
        'weather_afternoon', // 下午天氣
        'rule_4', // 四、本日施工項目是否有須依「營造業專業工程特定施工項目應置之技術士種類、比率或人數標準表」規定應設置技術士之專業工程：□有■無 （此項如勾選”有”，則應填寫後附「建築物施工日誌之技術士簽章表」）
        'safety_note', // 五、工地勞工安全衛生事項之督導、公共環境與安全之維護及其他工地行政事務：
        'validate_note', // 六、施工取樣試驗紀錄：
        'subcontractor_note', // 七、通知協力廠商辦理事項：
        'important_note', // 八、重要事項記錄
        'work_date', // 施工日期
    ];

    public function works()
    {
        return $this->belongsToMany(Work::class)->withPivot('amount')->withTimestamps();
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class)->withPivot('amount')->withTimestamps();
    }

    public function labors()
    {
        return $this->belongsToMany(Labor::class)->withPivot('amount')->withTimestamps();
    }

    public function appliances()
    {
        return $this->belongsToMany(Appliance::class)->withPivot('amount')->withTimestamps();
    }
}
