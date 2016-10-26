///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	Project:		Project 3   -Infix to Postfix
//	File Name:		PostFix.cs
//	Description:	Creates a PostFix string from Infix String
//	Course:			CSCI 2210 - Data Structures	
//	Author:			Jarred Wininger, Winingerj@goldmail.etsu.edu
//	Created:		Tuesday, November 3, 2015
//	Copyright:		Jarred Wininger, 2015
//
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace InfixToPostFixProj
{
    /// <summary>
    /// Creates Postfix string from passed infix string
    /// </summary>
    class PostFix
    {
        private string infixExpression;                 //infix expression
        private string postfixExpression;               //created postfix expression

        /// <summary>
        /// Getter/Setter for InfixExpression
        /// </summary>
        public string InfixExpression
        {
            get
            {
                return infixExpression;             //returns infix 
            }
            set
            {
                infixExpression = value;            //sets infix value to passed value
                postfixExpression = Convert ( );    //Converts to Postfix and sets postfix
            }
        }

        /// <summary>
        /// Getter/Setter for PostFix Expression
        /// </summary>
        public string PostfixExpression
        {
            get
            {
                return postfixExpression;           //returns postfix
            }
            set
            {
                postfixExpression = value;          //sets postfix value
            }
        }
         /// <summary>
         /// defualt constrcutor for PostFix
         /// </summary>
        public PostFix()
        {
            InfixExpression = "A+B-C";      //default infix expression
        }

        /// <summary>
        /// Constructor for PostFix
        /// </summary>
        /// <param name="infix"></param>
        public PostFix(string infix)
        {
            InfixExpression = infix;        //Infix expression set to passed string
        }
        /// <summary>
        /// Converts Infix string to Postfix String
        /// </summary>
        /// <returns></returns>
        public string Convert ( )
        {

            List<string> lInfix = new List<string> ( );                         //List to hold tokenized infix string
            bool valid;                                                         //holds if expression is valid
            Stack<string> stack = new Stack<string> ( );                        //stack to hold operators 
            Operator oper1 = new Operator ( );                                  //operator objects used for comparisons
            Operator oper2 = new Operator ( );
            string delims = "+-*/()= ";                                         //delimiters for tokenizer
            string strPost = "";                                                //generated postfix string
            string temp;                                                        //temporarily holds current token
            lInfix = Utility.Tokenize (infixExpression, delims);                //lInfix = tokenized string
            valid = InfixValidation (lInfix);                                   //valid = true if expression is valid

            if (valid == true)
            {
                //loop through list of tokens
                for (int i = 0; i < lInfix.Count ( ); i++)
                {

                    temp = lInfix[i];                                           //temp = current token
                    //if token is blank, do nothing
                    if (temp.Equals (" ") || temp.Equals (""))
                    {

                    }
                    //if token is an operator
                    else if ((temp.Equals ("+")) || lInfix[i].Equals ("-") || lInfix[i].Equals ("*") || lInfix[i].Equals ("/") || lInfix[i].Equals ("="))
                    {

                        oper1 = new Operator (lInfix[i]);               //create Operator using token
                        //if stack is not empty, create Operator using top of stack
                        if (stack.Count != 0)
                        {
                            oper2 = new Operator (stack.Peek ( ));
                        }
                        //if stack is empty create blank operator
                        else
                        {
                            oper2 = new Operator ("");
                        }
                        
                        while ((stack.Count ( ) != 0) && (oper2 > oper1) && !stack.Peek ( ).Equals ("("))
                        {
                            strPost += stack.Peek ( ) + " ";                        //add operator on stack to postfix string 
                            stack.Pop ( );                                          //Pop operator from stack
                        }
                        stack.Push (lInfix[i]);                                     //Push Current token onto stack


                    }

                    else if (temp.Equals ("("))
                    {
                        stack.Push (lInfix[i]);                                     //if token is (, push onto stack 
                    }
                    else if (temp.Equals (")"))
                    {
                        while (stack.Peek ( ) != "(" && stack.Count != 0)           //if token is ), add ops on stack to Postfix until ( reached
                        {
                            strPost += stack.Peek ( );                              //add operators to postfix
                            stack.Pop ( );                                          //Pop values off stack
                        }
                    }

                    else
                    {

                        strPost += lInfix[i] + " ";                                 //if not an operator, add to postfix
                    }


                }
                //if stack is not empty, pop values from stack and add them to postfix
                while (stack.Count != 0)
                {
                    if (stack.Peek ( ).Equals ("("))
                    {
                        stack.Pop ( );                      //if top of stack is (, pop without adding
                    }
                    else
                    {
                        strPost += stack.Peek ( ) + " ";    //if top is not (, add to postfix and pop from stack
                        stack.Pop ( );
                    }
                }
            }
            //if expression is not valid, display error in postfix box
            else
            {
                strPost = " ***ERROR*** Unpaired open parenthesis!";
            }
            
            return strPost;                                 //return postfix string

        }

        /// <summary>
        /// Determines if infix expression is valid
        /// </summary>
        /// <param name="infixList"></param>
        /// <returns>returns true if valid, false if not</returns>
        public bool InfixValidation (List<string> infixList)
        {
            bool valid = false;                                 //validity is false by default
            int open = 0;                                       //holds number of ( 
            int close = 0;                                      //holds number of ) 
                                                
            //loop through tokens
            for (int i = 0; i < infixList.Count ( ); i++)
            {
                //if token is (, add to open
                if (infixList[i].Equals ("("))
                {
                    open++;
                }
                //if token is ), add to close
                else if (infixList[i].Equals (")"))
                {
                    close++;
                }
                //if neither, do nothing
                else
                { }

            }
            //if open == close, then expression is valid
            if (open == close)
            {
                valid = true;
            }


            return valid;               //return valid
        }



    }
}
