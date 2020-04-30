<?php

namespace denis909\censoring\models;

class CensoringSearch extends Censoring
{

	public function rules()
	{
		return [
			[['id', 'created', 'search_for', 'replace_with', 'mode', 'length'], 'safe']
		];
	}

	public function applyToQuery($query)
	{
		$query->andFilterWhere([
			'id' => $this->id,
			'mode' => $this->mode,
			'length' => $this->length 
		]);

		if ($this->created)
		{
			$query->createdDate($this->created);
		}

		$query->andFilterWhere(['like', 'search_for', $this->search_for]);
		$query->andFilterWhere(['like', 'replace_with', $this->replace_with]);
	}

}