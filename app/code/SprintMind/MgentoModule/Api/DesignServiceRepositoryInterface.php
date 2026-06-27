<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule\Api;

/**
 * Interface DesignServiceRepositoryInterface
 * @api
 */
interface DesignServiceRepositoryInterface
{
    /**
     * Save design service data
     *
     * @param \SprintMind\MgentoModule\Api\Data\DesignServiceInterface $designService
     * @return int
     */
    public function save(Data\DesignServiceInterface $designService): int;

    /**
     * Retrieve design service data by ID
     *
     * @param int $id
     * @return \SprintMind\MgentoModule\Api\Data\DesignServiceInterface|null
     */
    public function getById(int $id): ?Data\DesignServiceInterface;

    /**
     * Delete design service data by ID
     *
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;

    /**
     * Retrieve all design services
     *
     * @return \SprintMind\MgentoModule\Api\Data\DesignServiceInterface[]
     */
    public function getList(): array;
}