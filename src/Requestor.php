<?php


namespace Victor78\SmsRegComponent;

use Victor78\SmsRegComponent\Exceptions\ValidationException;
use yii\base\Component;

/**
 * Class Requestor
 * @package Victor78\SmsRegComponent
 * @method array getNum(string $service, string $country = '')
 * @method array setReady(int $tzid)
 * @method array getState(int $tzid)
 * @method array getOperations(?string $opstate = null, ?int $count = null, ?string $output = null)
 * @method array getNumRepeat(int $tzid)
 * @method array getList(?int $extended = null)
 * @method array setOperationOk(int $tzid)
 * @method array setOperationUsed(int $tzid)
 * @method array vsimGet(string $period, string $country)
 * @method array vsimGetSMS(int $number)
 * @method array getBalance()
 * @method array setRate(float $rate)
 */
class Requestor extends Component
{
    /** @var string required */
    public $api_key;
    /** @var string optional */
    public $dev_key;

    /** @var bool  */
    public $enabledValidation = true;

    /** @var \Victor78\SmsReg\Requestor */
    private $requestor;

    /**
     * @throws ValidationException
     */
    public function init()
    {
        $this->validate();
        $this->initRequestor();
        parent::init();
    }

    /**
     * Прокси вызова
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $requestor = $this->getRequestor();

        return call_user_func_array([$requestor, $name], $arguments);
    }

    /**
     * @return Requestor
     */
    private function initRequestor(): self
    {
        $requestor = new \Victor78\SmsReg\Requestor($this->api_key, $this->dev_key, $this->enabledValidation);
        $this->setRequestor($requestor);
        return $this;
    }

    /**
     * @return \Victor78\SmsReg\Requestor
     */
    private function getRequestor(): \Victor78\SmsReg\Requestor
    {
        if (!$this->requestor)
        {
            $this->initRequestor();
        }
        return $this->requestor;
    }

    /**
     * @param mixed $requestor
     *
     * @return Requestor
     */
    private function setRequestor($requestor): self
    {
        $this->requestor = $requestor;
        return $this;
    }

    /**
     * @return Requestor
     * @throws ValidationException
     */
    private function validate(): self
    {
        if (!$this->api_key)
        {
            throw new ValidationException('Api key is required!');
        }
        return $this;
    }
}