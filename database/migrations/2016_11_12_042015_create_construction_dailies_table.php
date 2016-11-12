<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstructionDailiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construction_dailies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('weather_morning'); // 上午天氣
            $table->string('weather_afternoon'); // 下午天氣
            $table->boolean('rule_4'); // 四、本日施工項目是否有須依「營造業專業工程特定施工項目應置之技術士種類、比率或人數標準表」規定應設置技術士之專業工程：□有■無 （此項如勾選”有”，則應填寫後附「建築物施工日誌之技術士簽章表」）
            $table->string('safety_note'); // 五、工地勞工安全衛生事項之督導、公共環境與安全之維護及其他工地行政事務：
            $table->string('validate_note'); // 六、施工取樣試驗紀錄：
            $table->string('subcontractor_note'); // 七、通知協力廠商辦理事項：
            $table->string('important_note'); // 八、重要事項記錄
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('construction_dailies');
    }
}
