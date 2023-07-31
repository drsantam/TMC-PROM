{% set val1 = data.proctcae_palpitation_frequency %}
{% set val2 = data.proctcae_palpitation_severity %}

{% set tbl = [
	{ 'frequency' : 0, 'severity': 0, 'grade' : 0},
	{ 'frequency' : 1, 'severity': 0, 'grade' : 1},
	{ 'frequency' : 1, 'severity': 1, 'grade' : 1},
	{ 'frequency' : 1, 'severity': 2, 'grade' : 1},
	{ 'frequency' : 2, 'severity': 0, 'grade' : 1},
	{ 'frequency' : 2, 'severity': 1, 'grade' : 1},
	{ 'frequency' : 3, 'severity': 0, 'grade' : 1},
	{ 'frequency' : 3, 'severity': 1, 'grade' : 1},
	{ 'frequency' : 4, 'severity': 0, 'grade' : 1},
	{ 'frequency' : 4, 'severity': 1, 'grade' : 1},
	{ 'frequency' : 1, 'severity': 3, 'grade' : 2},
	{ 'frequency' : 1, 'severity': 4, 'grade' : 2},
	{ 'frequency' : 2, 'severity': 2, 'grade' : 2},
	{ 'frequency' : 2, 'severity': 3, 'grade' : 2},
	{ 'frequency' : 2, 'severity': 4, 'grade' : 2},
	{ 'frequency' : 3, 'severity': 2, 'grade' : 2},
	{ 'frequency' : 4, 'severity': 2, 'grade' : 2},
	{ 'frequency' : 3, 'severity': 3, 'grade' : 3},
	{ 'frequency' : 3, 'severity': 4, 'grade' : 3},
	{ 'frequency' : 4, 'severity': 3, 'grade' : 3},
	{ 'frequency' : 4, 'severity': 4, 'grade' : 3},
] %}


{% set matchingRow = tbl|filter(item => item.frequency == val1 and item.severity == val2)|last %}

{% if matchingRow %}
  {% set grade = matchingRow.grade %}
{% elseif val1 is not empty %}
  {% set grade = 0 %}
{% else %}  
  {% set grade = '' %}
{% endif %}
{{grade}}
