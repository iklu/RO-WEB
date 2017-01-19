<?php

namespace Front\CoreBundle\Helper\Flash;

interface FlashHelperInterface
{
    const FLASHES_NAME       = 'flashes';
    const FLASH_TYPE_SUCCESS = 'success';
    const FLASH_TYPE_ERROR   = 'error';
    const FLASH_TYPE_NOTICE  = 'notice';

    /**
     * Adds success message
     *
     * @param string $message
     * @param array  $params
     */
    public function addSuccess(string $message, array $params = []);

    /**
     * Adds notice message
     *
     * @param string $message
     * @param array  $params
     */
    public function addNotice(string $message, array $params = []);

    /**
     * Adds error message
     *
     * @param string $message
     * @param array  $params
     */
    public function addError(string $message, array $params = []);
}
