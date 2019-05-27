<?php
/**
 * Author: galih
 * Date: 2019-05-24
 * Time: 18:43
 */

namespace WebAppId\Region\Services\Params;


class RegionParam
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $parentId;
    /**
     * @var int
     */
    private $categoryId;
    /**
     * @var string
     */
    private $name;
    
    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    
    
    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }
    
    /**
     * @param int $parentId
     */
    public function setParentId(int $parentId): void
    {
        $this->parentId = $parentId;
    }
    
    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
    
    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}