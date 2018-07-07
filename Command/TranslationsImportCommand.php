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

class TranslationsImportCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this->setName('core:translations:import')
            ->setDescription('Imports translations from csv files')
            ->addOption('language', null, InputOption::VALUE_REQUIRED, 'Desired language', "Translation")
            ->addOption('iso', null, InputOption::VALUE_REQUIRED, 'ISO code', "iso")
            ->setHelp(<<<EOF
<info>php %command.full_name% </info> imports translations from %kernel.root_dir%/trans
directory into name.iso.yml

Example:
  <info>php %command.full_name% --language=Russian --iso=ru</info>
EOF
            );
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $language = $input->getOption('language');
        $iso = $input->getOption('iso');

        $kernel = $this->getApplication()->getKernel();
        $tsLangDir = $kernel->getRootDir() . "/../trans/{$language}";
        $finder = new Finder();
        $finder
            ->files()
            ->name('*.csv')
            ->in($tsLangDir);

        foreach ($finder as $file) {
            $bundle = $kernel->getBundle($file->getRelativepath());
            $tsFileName = sprintf(
                '%s/Resources/translations/%s.%s.yml',
                $bundle->getPath(),
                $file->getBasename('.csv'),
                $iso
            );
            $this->buildYml($tsFileName, $file);
            $output->writeLn(" --> Imported translation <comment>{$language}/" . basename($tsFileName) . "</comment>");
        }
    }

    private function buildYml($tsFilePath, \SplFileInfo $csvFile)
    {
        $yml = [];
        // open and read each csv line
        $csv = $csvFile->openFile('r');
        $csv->setFlags(\SplFileObject::READ_CSV);
        $csv->setCsvControl(";", "\"");
        foreach ($csv as $row) {
            // last row might be blank
            if (count($row) < 3) {
                continue;
            }
            list($key, $en, $trans) = $row;
            // skip CSV header
            if ($key === 'Key' && $en === 'English') {
                continue;
            }
            // split key
            $subKeys = explode('.', $key);
            // play with array element references, to fill keys
            $ref = &$yml;
            // loops subkeys key.subkey.subkey2 and builds an array based on it
            while ($k = array_shift($subKeys)) {
                if (!array_key_exists($k, $ref)) {
                    // make a subkey or set translation
                    // use english if not translated
                    $ref[$k] = count($subKeys) ? [] : ($trans ?: $en);
                }
                $ref = &$ref[$k];
            }
        }
        // write generated yaml translation
        $yamlDumper = new Dumper();
        $yamlDumper->setIndentation(2);

        $content = $yamlDumper->dump($yml, 10);
        file_put_contents($tsFilePath, $content, LOCK_EX);
    }
}
