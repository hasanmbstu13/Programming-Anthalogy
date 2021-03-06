###Question No 11:

Step-1:
UPDATE  QUESTIONAIRES
SET     Q11_IS_REGISTERED  = 3 WHERE ID IN (
SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS 
WHERE   (Q11_IS_REGISTERED IS NULL OR Q11_IS_REGISTERED = 99) 
AND Q4_UNIT_TYPE = 1);


Step-2:
UPDATE  QUESTIONAIRES
SET     Q11_IS_REGISTERED  = 3 WHERE ID IN (
SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS 
WHERE   (Q11_IS_REGISTERED IS NULL OR Q11_IS_REGISTERED = 99) 
AND Q4_UNIT_TYPE = 2
AND Q4_UNIT_ORG_TYPE = 2);


Step-3:
UPDATE  QUESTIONAIRES
SET Q11_IS_REGISTERED  = 2 WHERE ID IN (
SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS 
WHERE (Q11_IS_REGISTERED IS NULL OR Q11_IS_REGISTERED = 99) 
AND Q4_UNIT_TYPE = 2
AND Q4_UNIT_ORG_TYPE = 2
AND TOTAL_PERSON_ENGAGED < 10
);


Step-4:
UPDATE QUESTIONAIRES
SET  Q11_IS_REGISTERED  = 1 WHERE ID IN (
SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS 
WHERE (Q11_IS_REGISTERED IS NULL OR Q11_IS_REGISTERED = 99) 
AND Q4_UNIT_TYPE = 2
AND Q4_UNIT_ORG_TYPE = 2
AND TOTAL_PERSON_ENGAGED BETWEEN 10 AND 99 );


Step-5:
UPDATE  QUESTIONAIRES
SET     Q11_IS_REGISTERED = 1 WHERE ID IN (
SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS 
WHERE (Q11_IS_REGISTERED IS NULL OR Q11_IS_REGISTERED = 99) 
AND Q4_UNIT_TYPE = 2
AND Q4_UNIT_ORG_TYPE = 2
AND TOTAL_PERSON_ENGAGED >= 100);