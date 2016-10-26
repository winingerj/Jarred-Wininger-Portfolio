COMMENT #
***********************************************************************
* Program Name:	proj3.asm
* Programmer:	Jarred Wininger
* Class:	 	CSCI 2160
* Lab:   		Pro3
* Date:  		11/2/2015
* Purpose:  	Practice creating and calling methods 
*				
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
	addTwoNums  PROTO  stdcall, dnum1:dword, dnum2:dword
	extern extractDwords:near, displayArray:near, smallestValue:near 
	extern sumUpArray:near, selectionSort:near
	
	
	.data
input	byte 100 dup (?) 	; holds user input up to 100 characters
dArrayA dword 20 dup (?)	;first array of dwords
dArrayB dword 20 dup (?)	;second array of dwords
arrayString	byte 50 dup (?)	;string to display array 
dRowsA	dword ? 			;rows in array a 
dRowsB	dword ? 			;rows in array b 
dTotalA dword ?				;total of numbers in array a 
dTotalB dword ? 			;total of numbers in array b 
dColsA	dword ?				;cols in array a 
dColsB	dword ? 			;cols in array b 
dSumA	dword ? 			;sum of dwords in a 
dSumB	dword ?				;sum of dwords in b 
smallestNumA	dword ? 	;smallest dword in a 
smallestNumB	dword ?		;smallest dword in b 
strDisplayTotal byte 10 dup (?)
strEndByte		byte 0	;stops displaying after number of words is given
strName			byte	10,13,9,'Name: Jarred Wininger'
strClass		byte	10,13,9,'Class:	CSCI 2160-001'
strDate			byte	10,13,9,'Date:	10/15/2015'
strAssignment	byte	10,13,9,'Lab:	Project 2',0
strPrompt		byte 10,13,'If finished, just press ENTER, otherwise type'
strRowsA		byte 10,13,'Rows for Array A: ',0 
strColsA		byte 10,13,'Cols for Array A: ',0 
strRowsB		byte 10,13,'Rows for Array B: ',0 
strColsB		byte 10,13,'Cols for Array B: ',0 
strNumPromptA	byte 10,13,'Enter ' 
strNumPromptA2	byte ' values for Array A separated by a space (in row order)',0 
strNumPromptB	byte 10,13,'Enter '
strNumPromptB2	byte ' values for Array B separated by a space (in row order)',0 
strErrorMessage byte 10,13,'***ERROR - Cols for A MUST = Rows for B ***',0
strDisplayA		byte 10,13,'The Array A is described below: ',0 
strDisplayB		byte 10,13,'The Array B is described below: ',0 
strSum			byte 10,13,'The total of all the elements in this array is ',0
strSortedA		byte 10,13,'The sorted array A: ',0 
strSortedB		byte 10,13,'The sorted array B: ',0 
strSmallest		byte 10,13,'The Smallest Value In This Array Is: ',0
CRLF	byte	10,13,0		;used to advance to beginning of the next line



	
	
	.code
_start:
	mov eax,0									;dummy stmt for stopping debugger

	INVOKE putstring, ADDR strName				;display programmer info
	INVOKE putstring, ADDR CRLF 				;display blank line

	;get number of rows for A 
enterInfo:
	INVOKE putstring, ADDR strPrompt 			;prompt for Rows ArrayA 
	INVOKE getstring, ADDR input,10 			;get Rows 
	CMP byte ptr input,0 						;if user pushed ENTER without entering info
	JE finished									;end program
	INVOKE ascint32, ADDR input					;EAX = Rows 
	MOV dRowsA,EAX 								;dRowsA= rows in A 
	;get number of cols for A 
	INVOKE putstring, ADDR strColsA				;Prompt for Columns in A 
	INVOKE getstring, ADDR input,10 			;get Cols 
	INVOKE ascint32, ADDR input 				;EAX = Cols 
	MOV dColsA,EAX 								;dColsA = cols in A 
	INVOKE putstring, ADDR CRLF 
	;get number of rows for B 
	INVOKE putstring, ADDR strRowsB 			;prompt for Rows ArrayB
	INVOKE getstring, ADDR input,10 			;get Rows 
	INVOKE ascint32, ADDR input					;EAX = Rows 
	MOV dRowsB,EAX 								;dRowsA= rows in B 
	;get number of cols for B
	INVOKE putstring, ADDR strColsB				;Prompt for Columns in B
	INVOKE getstring, ADDR input,10 			;get Cols 
	INVOKE ascint32, ADDR input 				;EAX = Cols 
	MOV dColsB,EAX 								;dColsA = cols in B 
	INVOKE putstring, ADDR CRLF					;print blank line
	MOV EAX,dRowsB								;EAX = Rows in B
	CMP dColsA,EAX								;if Cols of A = Rows of B
	JE continue									;continue
	INVOKE putstring, ADDR strErrorMessage		;Else, Print error message 
	INVOKE putstring, ADDR CRLF 
	JMP enterInfo								;prompt for info again

continue:
	MOV EAX,dColsA 
	IMUL dRowsA 
	MOV dTotalA, EAX
	INVOKE putstring, ADDR strNumPromptA		;Prompt for dwords in array 
	INVOKE intasc32, ADDR input, dTotalA  
	INVOKE putstring,ADDR input
	INVOKE putstring, ADDR strNumPromptA2
	INVOKE putstring, ADDR CRLF 				;print blank line 
	INVOKE getstring, ADDR input,100			;get dwords for array A 
	
	;get values from array A
	LEA EAX,dArrayA								;EAX = address of dArrayA 
	PUSH EAX									;Push EAX onto Stack 
	LEA EAX,input 								;EAX = address of input 
	PUSH  EAX 									;Push EAX onto Stack 
	CALL extractDwords 							;extract dwords from string 
	ADD ESP, 8									;restore stack pointer
	

	MOV EAX,dRowsB
	IMUL dRowsB 
	MOV dTotalB,EAX 
	INVOKE putstring, ADDR strNumPromptB		;Prompt for dwords in array 
	INVOKE intasc32, ADDR input, dTotalB  
	INVOKE putstring,ADDR input
	INVOKE putstring, ADDR strNumPromptB2
	INVOKE putstring, ADDR CRLF 				;print blank line 
	INVOKE getstring, ADDR input,100			;get dwords for array A 
	
	;get values from array B
	LEA EAX,dArrayB								;EAX = address of dArrayA 
	PUSH EAX									;Push EAX onto Stack 
	LEA EAX,input 								;EAX = address of input 
	PUSH  EAX 									;Push EAX onto Stack 
	CALL extractDwords 							;extract dwords from string 
	ADD ESP, 8									;restore stack pointer

 

	;display array A
	INVOKE putstring,ADDR strDisplayA 			;Display array message
	INVOKE putstring, ADDR CRLF
	INVOKE putstring, ADDR CRLF
	LEA EAX,arrayString 						;Push address of arraystring onto stack
	PUSH EAX 
	PUSH dColsA 								;push columns in a
	PUSH dRowsA									;push rows in a
	LEA EAX,dArrayA								;push address of array a
	PUSH EAX 
	CALL displayArray							;display array a 
	ADD ESP, 16 								;restore stack pointer
	
	;sum up array A 
	INVOKE putstring,ADDR strSum 				;display sum message
	PUSH dColsA									;push columns in a
	PUSH dRowsA									;push rows in a
	LEA EAX,dArrayA								;push address of array a 
	PUSH EAX 
	CALL sumUpArray								;sum numbers in array
	ADD ESP,12									;restore stack pointer
	MOV dSumA,EAX								;dSumA = sum of numbers in array a
	INVOKE intasc32, ADDR input,dSumA			;convert sum into printable ascii
	INVOKE putstring, ADDR input				;print sum
	INVOKE putstring, ADDR CRLF

	;FIND SMALLEST VALUE IN ARRAY  A
	INVOKE putstring, ADDR strSmallest			;display smallest value message
	PUSH dColsA									;push cols in a
	PUSH dRowsA									;push rows in a
	LEA EAX,dArrayA								;push address of array a
	PUSH EAX 
	CALL smallestValue							;find smallest value in array
	MOV smallestNumA,EAX 						;smallestNumA = smallest number in a
	ADD ESP,12 									;restore stack pointer
	INVOKE intasc32, ADDR input,smallestNumA	;convert and display smallestNumA
	INVOKE putstring, ADDR input
	INVOKE putstring, ADDR CRLF
	
	;display array B
	INVOKE putstring,ADDR strDisplayB 			;display array message
	INVOKE putstring, ADDR CRLF
	INVOKE putstring, ADDR CRLF
	LEA EAX,arrayString 						;push address of printable string
	PUSH EAX 
	PUSH dColsB 								;push cols in b
	PUSH dRowsB									;push rows in b 
	LEA EAX,dArrayB								;push address of array b 
	PUSH EAX 			
	CALL displayArray							;display array b 
	ADD ESP, 16 								;restore stack pointer
	
	;sum up array B
	INVOKE putstring,ADDR strSum 				;display sum message 
	PUSH dColsB									;push cols in b 
	PUSH dRowsB									;push rows in b 
	LEA EAX,dArrayB								;push address of array b 
	PUSH EAX 
	CALL sumUpArray								;calculate sum of b 
	ADD ESP,12									;restore stack pointer 
	MOV dSumB,EAX								;dSumB = sum of B 
	INVOKE intasc32, ADDR input,dSumB			;convert and display dSumB
	INVOKE putstring, ADDR input
	INVOKE putstring, ADDR CRLF

	;FIND SMALLEST VALUE IN ARRAY  B
	INVOKE putstring, ADDR strSmallest			;display smallest value message 					
	PUSH dColsB									;push cols in b 
	PUSH dRowsB									;push rows in b 
	LEA EAX,dArrayB								;push address of array b 
	PUSH EAX 
	CALL smallestValue							;get smallest value of b 
	MOV smallestNumB,EAX 						;smallestNumB = smallest number in b 
	ADD ESP,12 									;restore stack pointer 
	INVOKE intasc32, ADDR input,smallestNumB	;convert and display smallestNumB 
	INVOKE putstring, ADDR input
	INVOKE putstring, ADDR CRLF



	;SORT AND DISPLAY ARRAY A
	INVOKE putstring, ADDR strSortedA 			;display sorted array message 
	INVOKE putstring, ADDR CRLF		
	MOV EAX,dRowsA 								;eax = rows in a 
	IMUL dColsA									;eax = number of dwords in array 
	PUSH EAX 									;push number of dwords in array 
	LEA EAX,dArrayA								;push address of array a 
	PUSH EAX 			
	CALL selectionSort							;selection sort on array a 
	ADD ESP,8 									;restore stack ptr 
	
	LEA EAX,arrayString 						;push address of printable string 
	PUSH EAX 				
	PUSH dColsA 								;push cols in a 
	PUSH dRowsA									;push rows in a 
	LEA EAX,dArrayA								;push address of array a 
	PUSH EAX 			
	CALL displayArray							;display array a 
	ADD ESP, 16 								;restore stack ptr 
	
	


	;SORT AND DISPLAY ARRAY B
	INVOKE putstring, ADDR strSortedB 			;display sorted array message 
	INVOKE putstring, ADDR CRLF
	MOV EAX,dRowsB								;eax = rows in b 
	IMUL dColsB									;eax = number of dwords in array 
	PUSH EAX 									;push  number of dwords in array 
	LEA EAX,dArrayB								;push address of array b 
	PUSH EAX 									
	CALL selectionSort							;selection sort array b 
	ADD ESP,8 									;restore stack ptr 
	
	LEA EAX,arrayString 						;push address of printable string 
	PUSH EAX 
	PUSH dColsB									;push cols in b
	PUSH dRowsB									;push rows in b 
	LEA EAX,dArrayB								;push address of b 
	PUSH EAX 
	CALL displayArray							;display array b 
	ADD ESP, 16 								;restore stack ptr 
	
	JMP enterInfo								;repeat until ENTER
finished:	
	INVOKE ExitProcess,0
	PUBLIC _start



	
	END