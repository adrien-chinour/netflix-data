<?php

namespace App\Model;

use App\Attribute\FileModel;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[FileModel(filename: "Content_Interaction/ViewingActivity.csv")]
class ViewingActivity extends Model
{
    #[SerializedName("Profile Name")]
    public string $profileName;

    #[SerializedName("Start Time")]
    public string $startTime;

    #[SerializedName("Duration")]
    public string $duration;

    #[SerializedName("Title")]
    public string $title;

    public function setProfileName(string $profileName): void
    {
        $this->profileName = $profileName;
    }

    public function setStartTime(string $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function setDuration(string $duration): void
    {
        $this->duration = $duration;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTrimmedTitle(): string
    {
        return explode(':', $this->title)[0];
    }

}
