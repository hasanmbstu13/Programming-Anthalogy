###Questions - 13:

Step-1:
UPDATE QUESTIONAIRES
SET (QUESTIONAIRES.Q13_SALE_PROCEDURE = VIEW_MAX_Q13_SALE_PROCEDURE.Q13_SALE_PROCEDURE)
FROM QUESTIONAIRES
INNER JOIN VIEW_MAX_Q13_SALE_PROCEDURE
ON
( QUESTIONAIRES.Q6_IND_CODE_CLASS_CODE = VIEW_MAX_Q13_SALE_PROCEDURE.Q6_BSIC_CODE)
WHERE (QUESTIONAIRES.Q13_SALE_PROCEDURE IS NULL OR QUESTIONAIRES.Q13_SALE_PROCEDURE = 9) 
AND (QUESTIONAIRES.Q6_IND_CODE_CLASS_CODE BETWEEN 4510 AND 4799) ;


Step-2:
UPDATE  QUESTIONAIRES
SET    Q13_SALE_PROCEDURE  = 3 WHERE ID IN 
( SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS
WHERE (Q13_SALE_PROCEDURE IS NULL OR Q13_SALE_PROCEDURE  = 9) 
AND (Q17_HR_MALE_FOC != 0 OR Q17_HR_FEMALE_FOC != 0 ) 
AND (Q17_HR_MALE = 0 
AND Q17_HR_FEMALE = 0 
AND Q17_HR_MALE_FULLTIME = 0 
AND Q17_HR_FEMALE_FULLTIME =0 
AND Q17_HR_MALE_IRREGULAR = 0
AND Q17_HR_FEMALE_IRREGULAR = 0 
AND Q17_HR_MALE_PARTTIME = 0 
AND Q17_HR_FEMALE_PARTTIME = 0)
AND (RMO_CODE = 1 OR RMO_CODE = 7)
AND  TOTAL_PERSON_ENGAGED < 5 );


UPDATE  QUESTIONAIRES
SET  Q13_SALE_PROCEDURE  = 1 WHERE ID IN (
SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS
WHERE (Q13_SALE_PROCEDURE IS NULL OR Q13_SALE_PROCEDURE  = 9)
AND RMO_CODE  IN (2,3,9)
AND  TOTAL_PERSON_ENGAGED BETWEEN  5 AND 9 );


UPDATE  QUESTIONAIRES
SET  Q13_SALE_PROCEDURE  = 2 WHERE ID IN (
SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS
WHERE (Q13_SALE_PROCEDURE IS NULL OR Q13_SALE_PROCEDURE  = 9)
AND RMO_CODE  IN (2,3,9)
AND  TOTAL_PERSON_ENGAGED BETWEEN  10 AND 99 );


UPDATE  QUESTIONAIRES
SET Q13_SALE_PROCEDURE  = 2 WHERE ID IN (
SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS
WHERE (Q13_SALE_PROCEDURE IS NULL OR Q13_SALE_PROCEDURE  = 9)
AND RMO_CODE  IN (2,3,9)
AND TOTAL_PERSON_ENGAGED >= 100 );