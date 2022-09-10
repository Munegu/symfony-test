<?php

namespace App\Command;

use App\Dto\DataProjectsDto;
use App\Repository\ProjectRepository;
use App\Service\SerializerService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[AsCommand(
    name: 'app:import-data',
    description: 'Import data from projects.xml',
)]
class ImportDataCommand extends Command
{
    private const PROJECT_XML_PATH = '/data/projects.xml';


    public function __construct(
        private SerializerService $serializer,
        private string $projectDir,
        private ProjectRepository $projectRepository
    )
    {
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);

        $fileName = sprintf('%s%s', $this->projectDir, self::PROJECT_XML_PATH);

        if (false === file_exists($fileName)) {
            $io->error('Doesn\' find xml file');
            return Command::FAILURE;
        }

        /**
         * @var DataProjectsDto
         */
        $dataProjectDto = $this->serializer->getSerializer()->deserialize(file_get_contents($fileName),DataProjectsDto::class, 'xml');


        foreach ($dataProjectDto->getProject() as $project){
            $this->projectRepository->add($project, true);
        }



        $io->success('Data imported in db with success !');

        return Command::SUCCESS;
    }
}
