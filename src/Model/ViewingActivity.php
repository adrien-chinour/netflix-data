<?php

namespace App\Model;

/**
 * Class ViewingActivity
 * @package App\Model
 */
class ViewingActivity extends Model
{
    static string $file = "Content_Interaction/ViewingActivity.csv";

    public string $profileName;

    public string $startTime;

    public string $duration;

    public string $title;

    public function setProfileName(string $profileName): ViewingActivity
    {
        $this->profileName = $profileName;
        return $this;
    }

    public function setStartTime(string $startTime): ViewingActivity
    {
        $this->startTime = $startTime;
        return $this;
    }

    public function setDuration(string $duration): ViewingActivity
    {
        $this->duration = $duration;
        return $this;
    }

    public function setTitle(string $title): ViewingActivity
    {
        $this->title = $title;
        return $this;
    }

    public function getTrimmedTitle(): string
    {
        return explode(':', $this->title)[0];
    }

}
