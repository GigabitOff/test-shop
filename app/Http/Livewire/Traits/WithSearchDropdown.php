<?php

namespace App\Http\Livewire\Traits;

trait WithSearchDropdown
{
    public $search;
    public $search_id;
    public $search_list;
    public $search_mode = false;

    public function updatedSearch($value)
    {
        $this->reset('search_id');
        $this->search_list = trim($value)
            ? $this->updateSearchList($value)
            : [];
        $this->search_mode = !empty($this->search_list);
    }

    public function updateSearchList($value)
    {
        return [];
    }

    public function setSearched($data)
    {
        $this->search = trim($data['value']);
        $this->search_id = $data['id'];
        $this->reset('search_mode');

        $this->onSearchSelected($this->search_id, $this->search);
    }

    public function onSearchSelected($id, $value)
    {
        return;
    }

    public function resetSearch()
    {
        $this->reset('search', 'search_id', 'search_list', 'search_mode');
        $this->onResetSearch();
    }

    public function onResetSearch()
    {
        return;
    }

    public function cancelSearchMode()
    {
        $this->search_mode = false;
    }
}
