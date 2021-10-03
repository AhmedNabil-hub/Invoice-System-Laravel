<?php

namespace App\Traits;

trait Filter
{
  public function scopeFilter($query, $filters)
  {
		if($filters){
			foreach($filters as $filter) {
				if(isset($filter['valuesRange'])) {
					if(in_array($filter['value'], $filter['valuesRange'])) {
						$query = $query->where($filter['type'], $filter['value']);
					}
				}
				else {
					$query = $query->where($filter['type'], $filter['value']);
				}
			}
		}

    return $query;
  }
}
