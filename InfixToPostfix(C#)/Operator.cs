///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	Project:		Project 3   -Infix to Postfix
//	File Name:		Operator.cs
//	Description:	Assigns precedence for operators and allows comparisons
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
    /// Operator class for comparing operators in Infix
    /// </summary>
    class Operator
    {
        private string op;          //operator
        private int precedence;     //precedence of operator
       

        /// <summary>
        /// Getter/Setter for operator
        /// </summary>
        public string Op
        {
            get
            {
                return op;                  //returns operator 
            }
            set
            {
                op = value;                 //set operator to value
                //update precedence
                switch(op)                            
                {
                    //if operator is + or -, precedence = 1 
                    case "+":
                        Precedence = 1;
                        break;
                    case "-":
                        Precedence = 1;
                        break;
                    //if operator is * or /, precedence = 2 
                    case "*":
                        Precedence = 2;
                        break;
                    case "/":
                        Precedence = 2;
                        break;
                    //if operator is ( or ), precedence =3
                    case "(":
                        Precedence = 3;
                        break;
                    case ")":
                        Precedence = 3;
                        break;
                    //if operator is =,"", or other, precedence = 0
                    case "=":
                        Precedence = 0;
                        break;
                    case "":
                        Precedence = 0;
                        break;
                    default:
                        Precedence = 0;
                        break;
                }//end switch(string)
            }//end set
        }

        /// <summary>
        /// Getter/Setter for Op Precedence
        /// </summary>
        private int Precedence
        {
            get
            {
                return precedence;          //returns value of precedence 
            }
            set
            {
                precedence = value;         //sets value of precedence to value
            }
        }

        /// <summary>
        /// Compares two Operator objects.
        /// </summary>
        /// <param name="lhs">left hand side of comparison</param>
        /// <param name="rhs">right hand side of comparison</param>
        /// <returns>returns boolean value </returns>
        public static bool operator < (Operator lhs, Operator rhs)
        {
            bool result = false;                    //result = false by default 
            //if op1 < op2
            if(lhs.precedence < rhs.precedence)                                     
            {
                result = true;                      //result = true 
            }

            return result;                          //return result
        }

        /// <summary>
        /// Compares two Operator objects
        /// </summary>
        /// <param name="lhs">left hand side of comparison</param>
        /// <param name="rhs">right hand side of comparison</param>
        /// <returns>returns boolean value</returns>
        public static bool operator >(Operator lhs, Operator rhs)
        {
            bool result = false;                    //result = false by default
            //if op1 > op2
            if(lhs.precedence > rhs.precedence)
            {
                result = true;                      //result = true
            }

            return result;                          //return result
        }

        /// <summary>
        /// default constructor for Operator. Sets Op to ""
        /// </summary>
        public Operator()
        {
            Op = "";
        }

        /// <summary>
        /// Constructor for Operator
        /// </summary>
        /// <param name="op">string value of operator</param>
        public Operator(string op)
        {
            Op = op;
        }
    }
}
