{% set val1 = data.proctcae_fecal_incontinence_frequency %}
{% set val2 = data.proctcae_fecal_incontinence_interference %}

{% set tbl = [
	{ 'frequency' : 0, 'interference': 0, 'grade' : 0},
	{ 'frequency' : 1, 'interference': 0, 'grade' : 1},
	{ 'frequency' : 1, 'interference': 1, 'grade' : 1},
	{ 'frequency' : 1, 'interference': 2, 'grade' : 1},
	{ 'frequency' : 2, 'interference': 0, 'grade' : 1},
	{ 'frequency' : 2, 'interference': 1, 'grade' : 1},
	{ 'frequency' : 2, 'interference': 2, 'grade' : 1},
	{ 'frequency' : 3, 'interference': 0, 'grade' : 1},
	{ 'frequency' : 3, 'interference': 1, 'grade' : 1},
	{ 'frequency' : 4, 'interference': 0, 'grade' : 1},
	{ 'frequency' : 4, 'interference': 1, 'grade' : 1},
	{ 'frequency' : 1, 'interference': 3, 'grade' : 2},
	{ 'frequency' : 1, 'interference': 4, 'grade' : 2},
	{ 'frequency' : 2, 'interference': 3, 'grade' : 2},
	{ 'frequency' : 2, 'interference': 4, 'grade' : 2},
	{ 'frequency' : 3, 'interference': 2, 'grade' : 2},
	{ 'frequency' : 4, 'interference': 2, 'grade' : 2},
	{ 'frequency' : 3, 'interference': 3, 'grade' : 3},
	{ 'frequency' : 3, 'interference': 4, 'grade' : 3},
	{ 'frequency' : 4, 'interference': 3, 'grade' : 3},
	{ 'frequency' : 4, 'interference': 4, 'grade' : 3},
] %}


{% set matchingRow = tbl|filter(item => item.frequency == val1 and item.interference == val2)|last %}

{% if matchingRow %}
  {% set grade = matchingRow.grade %}
{% elseif val1 is not empty %}
  {% set grade = 0 %}
{% else %}  
  {% set grade = '' %}
{% endif %}

{{grade}}
