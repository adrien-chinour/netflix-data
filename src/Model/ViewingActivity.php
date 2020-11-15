<?php

namespace App\Model;

/**
 * Class ViewingActivity
 * @package App\Model
 */
class ViewingActivity extends Model
{
    static string $file = "Content_Interaction/ViewingActivity.csv";

    private string $profileName;

    private string $startTime;

    private string $duration;

    private string $title;

    public function getProfileName(): string
    {
        return $this->profileName;
    }

    public function setProfileName(string $profileName): ViewingActivity
    {
        $this->profileName = $profileName;
        return $this;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function setStartTime(string $startTime): ViewingActivity
    {
        $this->startTime = $startTime;
        return $this;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): ViewingActivity
    {
        $this->duration = $duration;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getTrimedTitle(): string
    {
        return explode(':', $this->getTitle())[0];
    }

    public function setTitle(string $title): ViewingActivity
    {
        $this->title = $title;
        return $this;
    }

}
