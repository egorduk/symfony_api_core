<?php

namespace Btc\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Filesystem\Filesystem;

class TranslationsExportCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this->setName('core:translations:export')
            ->setDescription('Export translations to csv files')
            ->addOption('language', null, InputOption::VALUE_REQUIRED, 'Desired language', "Translation")
            ->setHelp(<<<EOF
<info>php %command.full_name% </info> exports translations to prefered language.

Example:
  <info>php %command.full_name% --language=Russian</info>
EOF
            );
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $language = $input->getOption('language');
        $kernel = $this->getApplication()->getKernel();
        $exportDir = $kernel->getRootDir() . '/../trans';
        $fs = new Filesystem();

        foreach ($kernel->getBundles() as $bundle) {
            if (is_dir($tsDir = $bundle->getPath().'/Resources/translations')) {
                $finder = new Finder();
                $translations = $finder
                    ->files()
                    ->name('*.en.yml')
                    ->in($tsDir);
                foreach ($translations as $file) {
                    // /sfproject/trans/LANG/BUNDLE/name.csv
                    $tsPath = sprintf(
                        '%s/%s/%s/%s.csv',
                        $exportDir,
                        $language,
                        $bundle->getName(),
                        $file->getBasename('.en.yml')
                    );
                    $fs->mkdir(dirname($tsPath), 0755);
                    $yaml = Yaml::parse(file_get_contents($file->getRealPath()));
                    $this->buildCsv($tsPath, $yaml, $language);
                    $output->writeLn(" --> Exported translation <comment>{$language}/" . basename($tsPath) . "</comment>");
                }
            }
        }
    }

    private function buildCsv($tsPath, array $yaml, $lang)
    {
        $lines = [];
        $parser = function($el, $key) use(&$parser, &$lines) {
            if (is_array($el)) {
                foreach ($el as $k => $v) {
                    $parser($v, $key . '.' . $k);
                }
            } else {
                $lines[ltrim($key, '.')] = $el;
            }
        };
        $parser($yaml, '');

        $stream = fopen("php://memory", "w");
        fputcsv($stream, ['Key', 'English', $lang], ';', '"');
        foreach ($lines as $key => $trans) {
            fputcsv($stream, [$key, $trans, ""], ';', '"');
        }
        fseek($stream, 0); // reset stream pos
        file_put_contents($tsPath, stream_get_contents($stream), LOCK_EX);
        @fclose($stream);
    }
}
