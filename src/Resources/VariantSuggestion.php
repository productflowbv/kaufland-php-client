<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class VariantSuggestion extends Model
{
    /**
     * @return mixed
     */
    public function listFeeds()
    {
        return $this->connection->request('GET', 'variant-suggestions/feed/', ['query' => $this->getQuery()]);
    }

    /**
     * @param $ean
     * @return array
     */
    public function showFeed($id_import_file)
    {
        return $this->connection->request('GET', "variant-suggestions/feed/{$id_import_file}");
    }

    /**
     * @param $ean
     * @param array $attributes
     * @return array
     */
    public function uploadFeed(string $url): array
    {
        return $this->connection->request('POST', 'variant-suggestions/feed/upload-by-url/', ['body' => ['url' => $url], 'query' => $this->getQuery()]);
    }
}
