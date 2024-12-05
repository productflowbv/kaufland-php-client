<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Subscription extends Model
{
    /**
     * Get a list of your push notification subscriptions.
     * @param array $queryParams 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function list(array $queryParams = []): array
    {
        return $this->connection->request('GET', 'subscriptions', [
            'query' => array_filter($this->getQuery() + $queryParams),
        ]);
    }

    /**
     * Get a push notification subscription by ID.
     * @param string $idSubscription 
     * @throws \InvalidArgumentException
     * @return array
     */
    public function show(string $idSubscription): array
    {
        if (empty($idSubscription)) {
            throw new InvalidArgumentException("Parameter 'id_subscription' is required.");
        }

        return $this->connection->request('GET', "subscriptions/{$idSubscription}");
    }

    /**
     * Subscribe for an event.
     * @param string $storefront
     * @param array $attributes 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function create(string $storefront, array $attributes): array
    {
        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        if (empty($attributes['callback_url'])) {
            throw new InvalidArgumentException("Parameter 'callback_url' is required.");
        }

        if (empty($attributes['event_name'])) {
            throw new InvalidArgumentException("Parameter 'event_name' is required.");
        }

        if (empty($attributes['fallback_email'])) {
            throw new InvalidArgumentException("Parameter 'fallback_email' is required.");
        }

        return $this->connection->request('POST', "subscriptions", [
            'query' => ['storefront' => $storefront],
            'body' => $attributes,
        ]);
    }

    /**
     * Update a subscription by ID.
     * @param string $idSubscription 
     * @param array $attributes 
     * @throws \InvalidArgumentException
     * @return array
     */
    public function update(string $idSubscription, array $attributes): array
    {
        if (empty($idSubscription)) {
            throw new InvalidArgumentException("Parameter 'id_subscription' is required.");
        }

        if (empty($attributes['callback_url'])) {
            throw new InvalidArgumentException("Parameter 'callback_url' is required.");
        }
        if (empty($attributes['event_name'])) {
            throw new InvalidArgumentException("Parameter 'event_name' is required.");
        }
        if (!isset($attributes['is_active'])) {
            throw new InvalidArgumentException("Parameter 'is_active' is required.");
        }
        if (empty($attributes['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        return $this->connection->request('PATCH', "subscriptions/{$idSubscription}", [
            'body' => $attributes,
        ]);
    }

    /**
     * Unsubscribe from an event by ID.
     * @param string $idSubscription 
     * @throws \InvalidArgumentException
     * @return array
     */
    public function delete(string $idSubscription): array
    {
        if (empty($idSubscription)) {
            throw new InvalidArgumentException("Parameter 'id_subscription' is required.");
        }

        return $this->connection->request('DELETE', "subscriptions/{$idSubscription}");
    }
}
