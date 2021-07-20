<?php
namespace Vnext\TrainingModule\Cron;
use Magento\Framework\Mail\Template\TransportBuilder;
use Vnext\TrainingModule\Helper\Email;

class SendMail
{
        /**
    * @var \Psr\Log\LoggerInterface
    */
    private $logger;
    private $helperMail;
    private $studentNewsFactory;
    private $collection;
    /**
    * @var TransportBuilder
    */
    private $transportBuilder;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        TransportBuilder $transportBuilder,
        \Vnext\TrainingModule\Helper\Email $helperMail,
        \Vnext\TrainingModule\Model\TrainingFactory $studentNewsFactory

    )
    {
        $this->logger = $logger;
        $this->transportBuilder = $transportBuilder;
        $this->helperMail = $helperMail;
        $this->studentNewsFactory = $studentNewsFactory;
        $this->collection = $this->getStudentCollection();


    }

    public function getStudentCollection(){
        $collection = $this->studentNewsFactory->create()->getCollection();
        return $collection;
    }


    /**
    * Execute the cron
    *
    * @return void
    */

    public function execute()
    {
        $students = $this->collection;
        foreach($students as $student){
            $daySTD = date('j',strtotime($student['dob']));
            $dayNow = date('j', time());
            $monthSTD = date('F',strtotime($student['dob']));
            $monthNow = date('F',time());
            if($daySTD == $dayNow && $monthSTD == $monthNow){
                $email = $student['email'];
                $name = $student['name'];
                // return $this->helperMail->sendEmail($email, $name);
            }
        }

     
    }
}

