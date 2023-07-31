{% set val1 = data.proctcae_dyspnea_severity %}
{% set val2 = data.proctcae_dyspnea_interference %}

{% set tbl = [
	{ 'severity' : 0, 'interference': 0, 'grade' : 0},
	{ 'severity' : 1, 'interference': 0, 'grade' : 1},
	{ 'severity' : 1, 'interference': 1, 'grade' : 1},
	{ 'severity' : 1, 'interference': 2, 'grade' : 1},
	{ 'severity' : 2, 'interference': 0, 'grade' : 1},
	{ 'severity' : 2, 'interference': 1, 'grade' : 1},
	{ 'severity' : 3, 'interference': 0, 'grade' : 1},
	{ 'severity' : 1, 'interference': 3, 'grade' : 2},
	{ 'severity' : 1, 'interference': 4, 'grade' : 2},
	{ 'severity' : 2, 'interference': 2, 'grade' : 2},
	{ 'severity' : 2, 'interference': 3, 'grade' : 2},
	{ 'severity' : 3, 'interference': 1, 'grade' : 2},
	{ 'severity' : 3, 'interference': 2, 'grade' : 2},
	{ 'severity' : 4, 'interference': 0, 'grade' : 2},
	{ 'severity' : 4, 'interference': 1, 'grade' : 2},
	{ 'severity' : 4, 'interference': 2, 'grade' : 2},
	{ 'severity' : 2, 'interference': 4, 'grade' : 3},
	{ 'severity' : 3, 'interference': 3, 'grade' : 3},
	{ 'severity' : 3, 'interference': 4, 'grade' : 3},
	{ 'severity' : 4, 'interference': 3, 'grade' : 3},
	{ 'severity' : 4, 'interference': 4, 'grade' : 3},
] %}


{% set matchingRow = tbl|filter(item => item.severity == val1 and item.interference == val2)|last %}

{% if matchingRow %}
  {% set grade = matchingRow.grade %}
{% elseif val1 is not empty %}
  {% set grade = 0 %}
{% else %}  
  {% set grade = '' %}
{% endif %}

{{grade}}
