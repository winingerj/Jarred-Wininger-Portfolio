COMMENT #
***********************************************************************
* Program Name:	proj3methods.asm
* Programmer:	Jarred Wininger
* Class:	 	CSCI 2160
* Lab:   		Proj3
* Date:  		11/2/2015
* Purpose:  	Contains all methods used for project 3
*				
*
***********************************************************************# 		
	.486
	.model flat
	.stack 100h
	
	ascint32	PROTO Near32 stdcall, lpStringToConvert:dword  
	intasc32	proto Near32 stdcall, lpStringToHold:dword, dval:dword
	putstring 	PROTO Near32 stdcall, lpStringToPrint:dword
	.code
COMMENT#
**************************************************************************************
*Method Name: extractDwords 
*Method Purpose: Extracts dwords from input string and stores int32 values in array 
*
*Date Created: 10/28/2015 
*
*@param lpArrayDwords, array to hold dword values 
*@param lpStringOfChars, input string of characters 
*************************************************************************************#
	extractDwords PROC
	PUSH EBP
	MOV EBP,ESP
	;PUSH USED REGISTERS
	PUSH EAX
	PUSH EBX 
	PUSH ECX 
	PUSH EDX 
	PUSH ESI 
	MOV EBX,[EBP+8]			;EBX --> STRING OF CHARS
	MOV ESI,[EBP+12] 		;ESI --> ARRAY OF DWORDS
	MOV EDX,0 				;holds offset for next dword insertion
	
	;FIND BEGINNING CHAR OF EACH NUMERIC DIGIT
findNums:
	CMP BYTE PTR [EBX],' '			;If Current Char in string is space,Increment Offset and Repeat
	JE incrementOffset 				 
	CMP BYTE PTR [EBX],','			;If Current Char in string is comma,Increment Offset and Repeat
	JE incrementOffset 
	CMP BYTE PTR [EBX],':'			;If Current Char in string is colon,Increment Offset and Repeat
	JE incrementOffset 
	CMP BYTE PTR [EBX],';'			;If Current Char in string is semicolon,Increment Offset and Repeat
	JE incrementOffset 
	CMP BYTE PTR [EBX],'	'		;If Current Char in string is tab,Increment Offset and Repeat
	JE incrementOffset
	CMP BYTE PTR [EBX],0 			;If Current Char in String is ENTER 
	JE finished 					;Jump to end of method 
	MOV ECX,EBX						;If valid numeric character found, Store Location in ECX 
	ADD EBX,1 						;Increment EBX 
	JMP findWhitespace				;Jump to findWhiteSpace 
incrementOffset:
	ADD EBX,1						;EBX = next character in input 
	JMP findNums					;Find Next Numeric Char 
	
findWhitespace:
	CMP BYTE PTR [EBX],' '			;If Current Char is SPACE 
	JE wsFound						;Jump to whitespaceFound 
	CMP BYTE PTR [EBX],','			;If Current Char in string is comma,Increment Offset and Repeat
	JE wsFound						;Jump to whitespaceFound
	CMP BYTE PTR [EBX],':'			;If Current Char in string is colon,Increment Offset and Repeat
	JE wsFound						;Jump to whitespaceFound
	CMP BYTE PTR [EBX],';'			;If Current Char in string is semicolon,Increment Offset and Repeat
	JE wsFound						;Jump to whitespaceFound
	CMP BYTE PTR [EBX],'	'		;If Current Char in string is tab,Increment Offset and Repeat
	JE wsFound						;Jump to whitespaceFound
	CMP BYTE PTR [EBX],0 			;If next byte is ENTER 
	JE lastWS						;It is the last whitespace
	ADD EBX,1 						;EBX = next character in input 
	JMP findWhitespace				;Repeat 
wsFound:
	MOV BYTE PTR [EBX],0			;Replace any found whitespace with SPACE 
	INVOKE ascint32, ECX			;EAX = Int32 dword of ASCII values in ECX 
	MOV DWORD PTR [ESI+EDX],EAX 	;Add converted dword to array  
	ADD EDX,4 						;Increment Array offset by 4 
	ADD EBX,1						;Increment input offset by 1 
	JMP findNums					;find next dword 
lastWS:
	MOV BYTE PTR [EBX],0			;Replace any found whitespace with SPACE 
	INVOKE ascint32, ECX			;EAX = Int32 dword of ASCII values in ECX 
	MOV DWORD PTR [ESI+EDX],EAX 	;Add converted dword to array  
	ADD EDX,4 						;Increment Array offset by 4 
	ADD EBX,1						;Increment input offset by 1 
	JMP finished		
finished:
	POP ESI 
	POP EDX
	POP ECX 
	POP EBX 
	POP EAX 
	POP EBP 
	RET
extractDwords endp

COMMENT#
**************************************************************************************
*Method Name: displayArray 
*Method Purpose: Formats Array of Dwords into the correct rows/cols to display  
*
*Date Created: 10/28/2015 
*
*@param lpArrayDwords, array of dword values 
*@param lpStringToHoldNumeric, holds row to output
*@param rows,	number of rows in array 
*@param cols,	number of cols in array 
*************************************************************************************#
displayArray PROC 
	PUSH EBP 
	MOV EBP,ESP 
	;PUSH USED REGISTERS 
	PUSH EAX 
	PUSH EBX 
	PUSH ECX 
	PUSH EDI 
	PUSH ESI 
	
	MOV ESI,[EBP+8]					;ESI -->Array Of Dwords 
	MOV EBX,[EBP+20]				;EBX -->Printable String
	MOV ECX,[EBP+16]				;ECX -->Number of Cols in Array 
	
	MOV EDI,0 						;used to check number of rows printed 
printArray:
	CMP ECX,0 						;if ecx=0
	JE printRow						;print converted row 
	MOV EAX, DWORD PTR [ESI] 		;eax=dword in array 
	CMP EAX,100						;if >100
	JGE threeDigitNum 				;go to convert 3 digit number 
	CMP EAX,10						;if >10 
	JGE twoDigitNum					;go to convert 2 digit number 
	INVOKE intasc32,  EBX, EAX		;ELSE, convert 1 digit number 
	ADD EBX,1						;Increment printable string position 
	MOV  byte ptr[EBX],'	'		;add tab seperator 
	ADD ESI,4 						;increment offset of array 
	ADD EBX,1						;increment printable string position 
	LOOP printArray 				;repeat 
printRow:
	MOV byte ptr [EBX],10			;add newline to string 
	ADD EBX,1 						;increment string 
	MOV byte ptr [EBX],13			;add return to string 
	ADD EBX,1 						;increment string 
	MOV byte ptr [EBX],0			;add null to string 
	MOV EAX,[EBP+20]				;eax --> printable string 	
	INVOKE putstring, EAX			;print string 
	MOV ECX,[EBP+16] 				;ecx -->number of cols in array 
	ADD EDI,1 						;increment offset 
	MOV EBX,[EBP+20]				;ebx --> printable string 
	CMP EDI,[EBP+12]				;if EDI =/= rows in array 
	JNE printArray 					;print next row 
	JMP finish						;else, end method 
twoDigitNum:
	INVOKE intasc32, EBX,EAX 		;convert number into ascii 
	ADD EBX,2						;increment string 
	MOV byte ptr[EBX],9 			;add tab to string 
	ADD ESI,4 						;increment array offset 
	ADD EBX,1 						;increment string 
	SUB ECX,1						;dec counter 
	JMP printArray					;jump to printArray 
threeDigitNum: 
	INVOKE intasc32, EBX,EAX 		;convert number into ascii 
	ADD EBX,3						;increment string 
	MOV byte ptr[EBX],9 			;add tab to string 
	ADD ESI,4 						;increment array offset 
	ADD EBX,1						;increment string 
	SUB ECX,1						;dec counter 
	JMP printArray					;jump to printArray 
finish:
	POP ESI 
	POP EDI 
	POP ECX 
	POP EBX 
	POP EAX 
	POP EBP
	RET
displayArray ENDP
	 
COMMENT#
**************************************************************************************
*Method Name: sumUpArray
*Method Purpose: Adds all values in array  
*
*Date Created: 10/28/2015 
*
*@param lpArrayDwords, array of dword values 
*@param rows,	number of rows in array 
*@param cols,	number of cols in array
*@returns dword, sum of all values in array 
*************************************************************************************#
sumUpArray PROC 
	PUSH EBP 
	MOV EBP,ESP 
	;PUSH ALL USED REGISTERS 
	PUSH EBX
	PUSH ECX 
	
	MOV EAX,[EBP+12]			;EAX -->rows in array 
	MOV EBX,[EBP+16]			;EBX --> cols in array 
	IMUL EBX 					;EAX=number of dwords in array 
	MOV ECX,EAX 				;ECX= number of dwords in array
	MOV EAX,0 					;clear eax
	MOV EBX,[EBP+8] 			;EBX -->lpArrayDwords 
sumValues:
	ADD EAX,dword ptr [EBX] 	;EAX+=Next Dword in Array 
	ADD EBX,4 					;Increment position for next Dword 
	LOOP sumValues 				;Repeat for each value 
	
	POP ECX
	POP EBX 
	POP EBP 
	RET 
sumUpArray ENDP
	
COMMENT#
**************************************************************************************
*Method Name: smallestValue
*Method Purpose: Finds the smallest value in array and returns it  
*
*Date Created: 10/30/2015 
*
*@param lpArrayDwords, array of dword values 
*@param rows,	number of rows in array 
*@param cols,	number of cols in array
*@returns dword, smallest value in array
*************************************************************************************#
smallestValue PROC 
	PUSH EBP 
	MOV EBP,ESP 
	;PUSH USED REGISTERS 
	
	PUSH EBX 
	PUSH ECX 
	PUSH ESI 
	;CODE 
	MOV EBX,[EBP+8]			;EBX --> Array of dwords 
	MOV EAX,[EBP+12]		;EAX = Number of Rows
	MOV ESI,[EBP+16]		;ESI = number of cols 
	IMUL ESI				;eax = number of dwords in array 
	MOV ECX,EAX 			;counter = number of dwords in array 
	MOV ESI,0 				;ESI = OFFSET FOR DWORD IN ARRAY 
	MOV EAX,[EBX+ESI]		;ASSUME First dword is the smallest.
	SUB ECX,1				;loop requires number of dwords - 1 loops
	
	
findSmallest:
	CMP ECX,0 					;if ecx = 0 
	JE finished 				;end method 
	ADD ESI,4 					;Increment ESI 
	CMP EAX,[EBX+ESI] 			;EAX > next value 
	JGE valueSmaller			;replace with next value 
	SUB ECX,1 					;Decrement ECX 
	JMP findSmallest			;repeat 
valueSmaller:
	MOV EAX,[EBX+ESI] 			;Store new smallest value in ECX 
	SUB ECX,1 					;Decrement ECX
	JMP findSmallest 			;repeat
finished: 	
	POP ESI 
	POP ECX 
	POP EBX 

	POP EBP 
	RET 
smallestValue ENDP
COMMENT#
**************************************************************************************
*Method Name: selectionSort
*Method Purpose: Sorts array from least to greatest
*
*Date Created: 10/31/2015 
*
*@param lpArrayOfDwords, array of dword values
*@param iLength, length of array  
*************************************************************************************#
selectionsort PROC 
	PUSH EBP 
	MOV EBP,ESP 
	PUSH EAX  
	PUSH EBX 
	PUSH ECX 
	PUSH EDX
	PUSH EDI 
	PUSH ESI 
	
	MOV EAX,[EBP+8]			;EAX -->Array of Dwords
	MOV ECX,[EBP+12] 		;ECX = Number of Dwords in Array 
	SUB ECX,1 				;ECX = Number of Dwords - 1, used for loop


	
	
sort:	
	MOV ESI,0				;Offset of Dword to Compare
	MOV EAX,[EBP+8]			;EAX --> Array
	MOV EBX,[EAX+ESI]		;Assume First Value is Largest
	MOV EDX,EAX 			;EDX --> array of dwords 
	ADD EDX,ESI				;EDX -->array of dwords + offset 
	PUSH EDX 				;store position of largest number on stack 
	ADD ESI,4 				;Increment To Next Dword 
findLargest:
	CMP EBX,[EAX+ESI] 		;Compare Next Value to Current Largest Value 
	JL newLargest			;If Larger, Jump to New Largest 
	
	MOV EAX,4				;EAX = Size of Dword
	IMUL ECX				;EAX = last offset for loop
	MOV EDI,EAX 			;EDI = last offset for loop 

	CMP ESI,EDI				;if offset = last offset for loop 
	JE swap					;swap the largest value to the next end of loop 
	ADD ESI,4				;increment offset 
	MOV EAX,[EBP+8]			;eax --> array of dwords 
	JMP findLargest			;find largest dword 
	
newLargest:
	POP EDX 				;edx = position of former largest dword 
	MOV EDX,EAX 			;edx --> array of dwords 
	ADD EDX,ESI 			;edx --> position of new largest dword 
	PUSH EDX				;store position of largest dword on stack 
	MOV EBX,[EAX+ESI]		;move largest dword value into ebx 
	MOV EAX,4  				;EAX = Size of Dword
	IMUL ECX 				;EAX = last offset for loop 
	MOV EDI,EAX 			;EDI = last offset for loop
	CMP ESI,EDI				;if offset is last offset for loop 
	JE swap 				;swap values 
	MOV EAX,[EBP+8]			;eax --> array 
	ADD ESI,4 				;increment offset 
	JMP findLargest			;find largest dword 
swap:
	MOV EAX,4
	IMUL ECX 				;EAX = Next Position for Dword 
	MOV ESI,[EBP+8]			;ESI --> Array 
	ADD ESI,EAX 
	MOV EDI,[ESI]			;EDI = Value of Last Dword in Loop 	
	MOV [ESI],EBX 			;Mov Largest Value to End 
	POP EDX
	MOV	[EDX],EDI			;Mov Value at end to largest values original position
	
	loop sort
	
	POP ESI 
	POP EDI
	POP EDX
	POP ECX 
	POP EBX 
	POP EAX 
	POP EBP
	RET 
selectionSort ENDP





	
COMMENT#
**************************************************************************************
*Method Name: multArrays
*Method Purpose: Multiplies Two Arrays and stores value in a Third Array
*Spent 8 hours on it. Couldnt figure it out. Doing selection sort instead.
*Date Created: 10/31/2015 
*
*@param lpArrayA, array of dword values
*@param lpArrayB, array of dword values 
*@param rowsA,	number of rows in array 
*@param colsA,	number of cols in array
*@param rowsB,	number of rows in array 
*@param colsB,	number of cols in array
*@param lpArrayC, resulting array 
*************************************************************************************	#
multArrays proc
RET
multArrays endp
END