;****************************************************************************
;* Program Name:	proj1.asm
;* Programmer:	Jarred Wininger
;* Class:	 	CSCI 2160
;* Lab:   		Proj1
;* Date:  		9/30/2015
;* Purpose:  	Prompts user for quantity of numbers to add, the value of those 
;* 				numbers, then stores those values and returns the sum.
;*
;****************************************************************************


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
dVal1	dword ?			;holds dword quantity of numbers to add
dNum1	dword 0			;stores sum of numbers
strNum1	byte	?		;holds ascii value of quantity of numbers to add 
strName	byte	10,13,9,'Name: Jarred Wininger'
strClass	byte	10,13,9,'Class:	CSCI 2160-001'
strDate		byte	10,13,9,'Date:	9/30/2015'
strAssignment	byte	10,13,9,'Lab:	Project 1',0
strPrompt	byte	10,13,9,'How many numbers to add: ',0
strEnterNum	byte	10,13,9,'Enter a number: ',0
strResult	byte	10,13,9,'The sum of these numbers is '
strSum byte	?		;holds sum of numbers in ascii
strEndByte	byte 0	;stops displaying after sum is given
dVal2	dword 11 dup(?)		;array of up to numbers to add
CRLF	byte	10,13,0		;used to advance to beginning of the next line



	
	
	.code
_start:
	mov eax,0							;dummy stmt for stopping debugger
	
	INVOKE putstring, ADDR	strName		;displays programmer's info and assignment info
	INVOKE putstring, ADDR	CRLF		;skip to a new line
	INVOKE putstring, ADDR	strPrompt	;prompts for how many numbers to be added
	INVOKE getstring, ADDR	strNum1,2	;limits input to 2 digits
	INVOKE ascint32, ADDR	strNum1		;converts ascii value in strNum to dword value and stores in EAX
	MOV	dVal1,EAX						;stores quantity of numbers to add in dVal1
	INVOKE putstring, ADDR	CRLF		;skip to new line
	MOV ECX,dVal1						;sets counter for loop
	MOV ESI,0 							;position to store next number in array
	
	stAddLoop:
		INVOKE putstring, ADDR strEnterNum	;prompts user for number
		INVOKE	getstring, ADDR strNum1,15	;limits to a 15 digit number
		INVOKE ascint32, ADDR strNum1		;converts input ascii to dword value
		MOV dval2[4*ESI],EAX				;stores input number in correct position in array
		INC ESI								;increment for next memory location to store operands
		ADD dNum1,EAX					;add input value to total

		LOOP stAddLoop ;
	
	INVOKE intasc32, ADDR strSum,dNum1	;converts sum of numbers to printable ascii characters
										;stores in strNum2
	INVOKE putstring, ADDR CRLF			;skip to new line
	INVOKE putstring, ADDR strResult	;displays the result string

	
	
	;code
	
	
	INVOKE ExitProcess,0
	PUBLIC _start
	
	
	
	END