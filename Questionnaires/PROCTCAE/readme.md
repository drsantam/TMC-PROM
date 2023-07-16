[PROCTCAE](https://healthcaredelivery.cancer.gov/pro-ctcae/) is a patient reported outcomes system developed by the National Cancer Institute (NCI) USA. This allows patient reported outcomes to be mapped to symptomatic CTCAE terms. As per the website accessed on 16th July, 2023 the following is mentioned:
> PRO-CTCAE and the Ped-PRO-CTCAE module are publicly available for all to use in their clinical research and we encourage and facilitate this use.

The YAML file has the entire corpus of 80 CTCAE AE from the adult version of the PROCTCAE item bank. 

It is important to note that **branching logic** is not implemented in the template but same should be used as recommended on the PROCTCAE website. We recommend that once the questions are finalized then the following logic should be used: 
1. For questions which have a frequency and severity item - the severity item should be shown to the user only if the frequency is more than never.
2. For questions that have a severity and interference item - the interference item should be shown only if the severity is more than "Did not have any" response. 
