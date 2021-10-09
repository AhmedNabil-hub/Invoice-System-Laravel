<?php

namespace App\Traits;

use function PHPUnit\Framework\isEmpty;

trait Filter
{
  public function scopeSearchFilter($query, $filter)
  {
		if(is_array($filter)){
			$query = $query->where($filter['type'], 'like', "%{$filter['value']}%");
		}

    return $query;
  }
}
