<?php

namespace Front\CoreBundle\Helper\Translator;

interface TranslatorHelperInterface
{
    const DEFAULT_TRANSLATION_DOMAIN = 'wellcommerce';

    /**
     * Translates the given string using translator service
     *
     * @param string $message
     * @param array  $parameters
     * @param string $domain
     *
     * @return string
     */
    public function trans(string $message, array $parameters = [], string $domain = self::DEFAULT_TRANSLATION_DOMAIN) : string;

    /**
     * Returns all messages for given locale and domain
     *
     * @param string $locale
     * @param string $domain
     *
     * @return array
     */
    public function getMessages(string $locale, string $domain = self::DEFAULT_TRANSLATION_DOMAIN) : array;
}
