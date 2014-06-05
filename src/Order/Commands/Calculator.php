<?php

namespace Order\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use \Order\Services\OrderCalculator;
use \Order\Entities\OrderFactory;
use Order\Utils\XmlElement;

class Calculator extends Command {

  /**
   * @var OrderCalculator 
   */
  private $orderCalculator;
  
  /**
   * @param OrderCalculator $orderCalculator
   * @param string $name
   */
    public function __construct(OrderCalculator $orderCalculator, $name = NULL)
    {
        $this->orderCalculator = $orderCalculator;
        parent::__construct($name);
    }
    
    protected function configure()
    {   
        $this->setName("offer:calculator")
            ->setDescription("Display the order from an XML file and update its total.")
            ->addArgument('xml', InputArgument::REQUIRED, 'Which xml you want to proceed')
            ->addOption('applyOffer', null, InputOption::VALUE_NONE, 'If set, the task will apply offer to order');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $xml = $input->getArgument('xml');
        if ($xml) {
          $this->orderCalculator->setOrder(OrderFactory::create(new XmlElement($xml, null, true)));
        }

        if ($input->getOption('applyOffer')) {
            $this->orderCalculator->applyPromotio2for3();
            $this->orderCalculator->applyPromotio50off();
        }

        $output->writeln($this->orderCalculator->getOrder()->getTotal());
    }
}