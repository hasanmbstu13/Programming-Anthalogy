###Question No 11.1:


Step-1:

UPDATE  QUESTIONAIRES
SET     Q11_REGISTRAR_ID  = 9 
WHERE ID IN (
SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS
WHERE   (Q11_REGISTRAR_ID IS NULL OR Q11_REGISTRAR_ID = 99) 
AND  Q11_IS_REGISTERED = 1
AND  Q4_UNIT_TYPE = 1
AND RMO_CODE IN (1,3,7));


    
Step-2:
UPDATE  QUESTIONAIRES
SET     Q11_REGISTRAR_ID  = 8
WHERE ID IN
( SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS
WHERE   (Q11_REGISTRAR_ID IS NULL OR Q11_REGISTRAR_ID = 99) 
AND  Q11_IS_REGISTERED = 1
AND  Q4_UNIT_TYPE = 1
AND RMO_CODE =  2 );  

Step-3:
UPDATE  QUESTIONAIRES
SET     Q11_REGISTRAR_ID  = 7
WHERE ID IN
( SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS
WHERE (Q11_REGISTRAR_ID IS NULL OR Q11_REGISTRAR_ID = 99) 
AND  Q11_IS_REGISTERED = 1
AND  Q4_UNIT_TYPE = 1
AND RMO_CODE =  9);         

Step-4:
UPDATE  QUESTIONAIRES
SET Q11_REGISTRAR_ID  = 9
WHERE ID IN
( SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS
WHERE(Q11_REGISTRAR_ID IS NULL OR Q11_REGISTRAR_ID = 99) 
AND  Q11_IS_REGISTERED = 1
AND Q4_UNIT_ORG_TYPE = 1
AND Q4_UNIT_TYPE = 2
AND RMO_CODE IN ( 1,3,7)
AND TOTAL_PERSON_ENGAGED < 10);         
        

Step-5:
UPDATE  QUESTIONAIRES
SET Q11_REGISTRAR_ID  = 3
WHERE ID IN
( SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS
WHERE (Q11_REGISTRAR_ID IS NULL OR Q11_REGISTRAR_ID = 99) 
AND  Q11_IS_REGISTERED = 1
AND Q4_UNIT_ORG_TYPE = 1
AND Q4_UNIT_TYPE = 2 
AND RMO_CODE IN(1,3,7)
AND TOTAL_PERSON_ENGAGED BETWEEN 10 AND 49         
);              


Step-6:
UPDATE  QUESTIONAIRES
SET Q11_REGISTRAR_ID  = 2
WHERE ID IN
( SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS
WHERE   (Q11_REGISTRAR_ID IS NULL OR Q11_REGISTRAR_ID = 99) 
AND  Q11_IS_REGISTERED = 1
AND Q4_UNIT_ORG_TYPE = 1
AND Q4_UNIT_TYPE = 2
AND RMO_CODE IN(1,3,7)
AND TOTAL_PERSON_ENGAGED BETWEEN 50 AND 99 );        

Step-7:
UPDATE  QUESTIONAIRES
SET Q11_REGISTRAR_ID = 1
WHERE ID IN( SELECT QUESTIONNARIE_ID FROM BBSEC2013_REPORTS
WHERE(Q11_REGISTRAR_ID IS NULL OR Q11_REGISTRAR_ID = 99) 
AND Q11_IS_REGISTERED = 1
AND Q4_UNIT_ORG_TYPE = 1
AND Q4_UNIT_TYPE = 2
AND RMO_CODE IN(1,3,7)
AND TOTAL_PERSON_ENGAGED >= 100 );   