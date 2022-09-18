<?php

namespace App\Services\Helpers;

class HostsHelper
{
    /**
     * get host from a url
     *
     * @param string $urlString
     * @return string
     */
    public static function getHostFromString(string $urlString): string
    {
        $hostDetails = parse_url($urlString);
        if (array_key_exists('host', $hostDetails)) {
            return $hostDetails['host'];
        }
        if (array_key_exists('path', $hostDetails)) {
            return $hostDetails['path'];
        }
        return $urlString;
    }

    /**
     * Get search criteria for host that's mapped with db's domain/subdomain
     *
     * @param string $host
     * @return array
     */
    public static function getSearchCriteriaForAHost(string $host): array
    {
        $domain = self::getHostFromString($host);

        if ($domain == 'localhost') {
            return ['subdomain' => 'test'];
        }

        if (strpos($domain, config('app.brand_site')) !== false) {
            return ['subdomain' => substr($domain, 0, strpos($domain, '.'))];
        }

        return ['domain' => $domain];


    }
}
