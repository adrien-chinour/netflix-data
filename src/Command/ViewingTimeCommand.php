<?php

namespace App\Command;

use App\Model\ViewingActivity;
use App\Utils\TimeHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ViewingTimeCommand extends Command
{

    private SymfonyStyle $io;

    public function __construct(string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName("time");
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = ViewingActivity::load();

        $this->io->title("Viewing time by profile");
        $this->io->table(['profile', 'time'], $this->calculTimeByProfile($data));

        $this->io->title("Viewing time by program");
        $this->io->table(['title', 'profile', 'time'], $this->calculTimeByTitle($data));

        return 0;
    }

    /**
     * @param ViewingActivity[] $data
     * @return array
     */
    private function calculTimeByProfile(array $data): array
    {
        $profileViewedTime = [];

        foreach ($data as $activity) {
            $key = $activity->profileName;
            if (!isset($profileViewedTime[$key])) {
                $profileViewedTime[$key] = ['profile' => $activity->profileName, 'time' => 0];
            }

            $profileViewedTime[$key]['time'] += TimeHelper::timeToSeconds($activity->duration);
        }

        // set readable time
        $profileViewedTime = array_map(function ($item) {
            $item['time'] = TimeHelper::toBetterUnit($item['time']);
            return $item;
        }, $profileViewedTime);

        return $profileViewedTime;
    }

    /**
     * @param ViewingActivity[] $data
     * @return array
     */
    private function calculTimeByTitle(array $data): array
    {
        $programViewedTime = [];

        foreach ($data as $activity) {
            $key = $activity->getTrimmedTitle() . $activity->profileName;
            if (!isset($programViewedTime[$key])) {
                $programViewedTime[$key] = ['title' => $activity->getTrimmedTitle(), 'profile' => $activity->profileName, 'time' => 0];
            }

            $programViewedTime[$key]['time'] += TimeHelper::timeToSeconds($activity->duration);
        }

        // order by viewing time
        usort($programViewedTime, function ($a, $b) {
            return $a['time'] < $b['time'];
        });

        // remove junk program
        $programViewedTime = array_filter($programViewedTime, function ($item) {
            return !str_contains($item['title'], "Bande-annonce")
                && !str_contains($item['title'], '_');
        });

        // set readable time
        $programViewedTime = array_map(function ($item) {
            $item['time'] = TimeHelper::toBetterUnit($item['time']);
            return $item;
        }, $programViewedTime);

        return $programViewedTime;
    }

}
