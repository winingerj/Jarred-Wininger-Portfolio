COMMENT #
***********************************************************************
* Program Name:	proj2.asm
* Programmer:	Jarred Wininger
* Class:	 	CSCI 2160
* Lab:   		Proj2
* Date:  		10/15/2015
* Purpose:  	To practice comparing values in assembly. Takes user input 
*				and displays the number of words of certain sizes.
*
***********************************************************************# 				


	.486
	.model flat
	.stack 100h
	
	ExitProcess PROTO stdcall, dVal:dword
	putstring 	PROTO Near32 stdcall, lpStringToPrint:dword
	ascint32	PROTO Near32 stdcall, lpStringToConvert:dword  
	intasc32	proto Near32 stdcall, lpStringToHold:dword, dval:dword
	getstring	PROTO Near32 stdcall, lpStringToGet:dword, dlength:dword
	putstring 	PROTO Near32 stdcall, lpStringToPrint:dword
	
	.data
input	byte 129 dup (?)	; holds user input up to 128 characters
dWord1	word	0			;number of single letter words
dWord2	word	0			;number of 2 letter words
dWord3	word 	0			;number of 3 letter words
dWord4	word 	0 			;number of 4 letter words
dWord5	word	0 			;number of 5+ letter words
dTotalWords	word	0		;total number of words
strNumWords	byte ?			;string to hold converted number 
strEndByte	byte 0	;stops displaying after number of words is given
strName	byte	10,13,9,'Name: Jarred Wininger'
strClass	byte	10,13,9,'Class:	CSCI 2160-001'
strDate		byte	10,13,9,'Date:	10/15/2015'
strAssignment	byte	10,13,9,'Lab:	Project 2',0
strWord1	byte	10,13,9,'1-letter words: ',0 
strWord2	byte	10,13,9,'2-letter words: ',0 
strWord3	byte	10,13,9,'3-letter words: ',0 
strWord4	byte	10,13,9,'4-letter words: ',0 
strWord5	byte	10,13,9,'5+ letter words: ',0 
strTotal	byte	10,13,9,'Total Words: ',0 
strPromptForString	byte 10,13,9,'Either type a string or simply hit ENTER without typing anything.',0
CRLF	byte	10,13,0		;used to advance to beginning of the next line



	
	
	.code
_start:
	mov eax,0							;dummy stmt for stopping debugger
	INVOKE putstring, ADDR strName		;display programmer info
	
prompt:
	INVOKE putstring, ADDR strPromptForString	;prompts user for a string
	INVOKE putstring, ADDR CRLF 				;next line
	INVOKE getstring, ADDR input,128			;stores string 
	MOV ESI,0									;initialize counter for position in string
	CMP input,0								;if ENTER was all the user entered, end the program
	JE finish									;jump to finish to end program
	JMP compareToDelims							;jump to find words
finish:
	JMP endProgram		;jumps to final label to end program
compareToDelims:
	MOV EBX,0				;holds the size of the current word
	MOV AL,input[ESI]		;AL = current character in string
	CMP AL,' '				;If AL = whitespace
	JE addToIndex			;Jump to label
	CMP AL,','				;If AL = comma
	JE addToIndex			;Jump to label
	CMP AL,0				;If AL = ENTER 
	JE 	wordCheck			;Jump to label
	JMP wordFound			;Start of word has been found

addToIndex:		
	INC ESI					;increment the position counter for string character
	JMP compareToDelims		;Jump to compare next character
wordFound:
	ADD EBX,1			;Word Size += 1 
	INC ESI				;Increment the position of next character
	MOV AL,input[ESI]	;AL = Current Character in String
	CMP AL,' '			;If AL = Whitespace
	JE addWord			;Jump to add word to size count
	CMP AL,','			;IF AL = comma 
	JE addWord			;Jump to add word to size count
	CMP AL,0 			;IF AL = ENTER
	JE addWord			;jump to addWord
	JMP wordFound		;Not a delim, jump to wordFound
wordCheck:
	CMP dTotalWords,0	;if the total number of words is 0
	JE finish 			;jump to finish to end program
	JMP displayCount	;jump to display results
addWord:
	CMP EBX,1		;if word is one letter long
	JE addSize1		;add to size 1
	CMP EBX,2		;if word is 2 letters long
	JE addSize2		;add to size 2
	CMP EBX,3		;if word is 3 letters long
	JE addSize3		;add to size 3
	CMP EBX,4		;if word is 4 letters long 
	JE addSize4		;add to size 4
	JMP addSize5	;add to size 5

;increments number of words for specified size
addSize1:
	ADD dWord1,1		;increment Word1 by 1
	ADD dTotalWords,1	;increment total number of words by 1
	CMP AL,0 			;if the current character is ENTER
	JE displayCount		;display results
	INC ESI				;increment position counter
	JMP compareToDelims	;find next word
addSize2:
	ADD dWord2,1		;increment word2 by 1
	ADD dTotalWords,1	;increment total number of words by 1
	CMP AL,0 			;if current character is ENTER
	JE displayCount		;display results
	INC ESI				;increment position counter
	JMP compareToDelims	;find next word
addSize3:
	ADD dWord3,1 		;increment word3 by 1
	ADD dTotalWords,1	;increment total number of words by 1
	CMP AL,0			;if current character is ENTER
	JE displayCount		;display results
	INC ESI				;increment position counter
	JMP compareToDelims	;find next word
addSize4:
	ADD dWord4,1		;increment word4 by 1
	ADD dTotalWords,1	;increment total number of words by 1
	CMP AL,0			;if current character is ENTER
	JE displayCount		;display results
	INC ESI				;increment position counter
	JMP compareToDelims	;find next word
addSize5:
	ADD dWord5,1		;increment word5 by 1
	ADD dTotalWords,1	;increment total number of words by 1
	CMP AL,0			;if current character is ENTER
	JE displayCount		;display results
	INC ESI				;increment position counter
	JMP compareToDelims	;find next word
displayCount:
	INVOKE putstring, ADDR CRLF 				;next line
	INVOKE intasc32, ADDR strNumWords,dWord1	;convert dWord1 to ascii
	INVOKE putstring, ADDR strWord1 			;display 1 letter word label
	INVOKE putstring, ADDR strNumWords			;display number of 1 letter words 
	INVOKE intasc32, ADDR strNumWords,dWord2	;convert dWord2 to ascii 
	INVOKE putstring, ADDR strWord2 			;display 2 letter word label 
	INVOKE putstring, ADDR strNumWords 			;display number of 2 letter words 
	INVOKE intasc32, ADDR strNumWords,dWord3	;convert dWord3 to ascii 
	INVOKE putstring, ADDR strWord3				;display 3 letter word label 
	INVOKE putstring, ADDR strNumWords			;display number of 3 letter words 
	INVOKE intasc32, ADDR strNumWords,dWord4 	;convert dWord4 to ascii 
	INVOKE putstring, ADDR strWord4 			;display 4 letter word label 
	INVOKE putstring, ADDR strNumWords			;display number of 4 letter words 
	INVOKE intasc32, ADDR strNumWords,dWord5	;convert dWord5 to ascii 
	INVOKE putstring, ADDR strWord5				;display 5 letter word label 
	INVOKE putstring, ADDR strNumWords			;display number of 5 letter words 
	INVOKE putstring, ADDR CRLF					;new line
clearCount:			;clears all word counts for next string 
	MOV dWord1,0 	;sWord1 = 0 
	MOV dWord2,0 	;sWord2 = 0 
	MOV dWord3,0 	;sWord3 = 0 
	MOV dWord4,0    ;sWord4 = 0 
	MOV dWord5,0 	;sWord5 = 0
	MOV dTotalWords,0 	;sTotalWords = 0 
	JMP prompt		;prompt for next string
endProgram:
	
	
	
	INVOKE ExitProcess,0
	PUBLIC _start
	
	
	
	END