////////////////////////////////////////////////////////////////////////////////////////////
//  Solution/Project:   SortingAlgorithms
//  File Name:          Sorting.cs
//  Description:        Various sorting methods for sorting lists of integers. 
//  Course:             CSCI 2210 - Data Structures
//  Author              Jarred Wininger, winingerj@goldmail.etsu.edu
//  Created:            Monday, October 19, 2015
//////////////////////////////////////////////////////////////////////////////////////////////
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SortingAlgorithms
{
    class Sorting
    {
        /// <summary>
        /// Main Method for initializing lists, populating lists, and calling sort methods.
        /// </summary>
        /// <param name="args"></param>
        static void Main (string[] args)
        {


            List<int> sinkList = new List<int> ( );         //list used for sink sort
            List<int> selList = new List<int> ( );          //list used for selection sort
            List<int> insertList = new List<int> ( );       //list used for insertion sort
            List<int> mergList = new List<int> ( );         //list used for merge sort
            List<int> qsoList = new List<int> ( );          //list used for quick sort original
            List<int> qsmList = new List<int> ( );          //list used for quick sort median of 3
            List<int> shellList = new List<int> ( );        //list used for shell sort
            Random R = new Random ( );

            //populate first list with random numbers
            for (int i = 0; i < 10; i++)
            {
                sinkList.Add (R.Next ( ));
            }
            //preProcessSort (sinkList);        //sort initially for testing sort methods with presorted lists
            //copy the contents of sinkList into each other list
            //  giving them all the same values so we can compare their performance accurately
            selList = copyList (sinkList);      
            insertList = copyList (sinkList);
            mergList = copyList (sinkList);
            qsoList = copyList (sinkList);
            qsmList = copyList (sinkList);
            shellList = copyList (sinkList);

             displayNumbers (shellList);        //display numbers to test if numbers copied correctly


            sinkSort (sinkList);                             //sorts using Sinking Sort
            SelectionSort (selList, selList.Count ( ));      //sorts using Selection Sort
            InsertionSort (insertList);                      //sorts using insertion sort
            MergeSort (mergList);                            //sorts using merge sort
            OriginalQuickSort (qsoList);                     //sorts using original quick sort
            QuickMedianOfThreeSort (qsmList);                //sorts using quick sort median of 3
            displayNumbers (qsmList);        //test to see if numbers were sorted correctly
            ShellSort (shellList);                           //sorts using shell sort
            displayNumbers (shellList);                     //test to see if numbers were sorted correctly  

         



        }
        /// <summary>
        /// Displays numbers in list
        /// </summary>
        /// <param name="l">list of integers</param>
          public static void displayNumbers(List<int> l)
          {
            //loops through list and displays each number
              for(int i =0;i<10;i++)
              {
                  Console.WriteLine (l[i]+"\n\n");
              }
          }//end displayNumbers(List<int>)
        
        
        /// <summary>
        /// Copys the contents from one list into a new one and returns the new list
        /// </summary> 
        /// <param name="l"> list of integers</param> 
        public static List<int> copyList (List<int> l)
        {
            List<int> newList = new List<int> ( );   //new list to hold integers
            //loops through l and adds integers to newList
            for (int i = 0; i < 10; i++)
            {
                newList.Add (l[i]);
            }
            return newList;       //returns newList

        }
        /// <summary>
        /// Preliminary sort for testing other sorting methods
        /// </summary>
        /// <param name="list">list of integers</param>
        public static void preProcessSort (List<int> list)
        {
            bool sorted = false;
            int pass = 0;
            int N = list.Count;

            while (!sorted && (pass < 8))
            {
                pass++;
                sorted = true;

                for (int i = 0; i < N - pass; i++)
                {
                    if (list[i] > list[i + 1])
                    {
                        Swap (list, i, i + 1);
                        sorted = false;
                    }
                }

            }

        }
        /// <summary>
        /// Sinking Sort compares adjacent values and swaps them
        /// </summary>
        /// <param name="list">List of Integers</param>
        public static void sinkSort (List<int> list)
        {
            bool sorted = false;
            int pass = 0;
            int N = list.Count;
            //sort until sorted or enough passes completed
            while (!sorted && (pass < N))
            {
                pass++;
                sorted = true;                          //assume sorted until proven otherwise

                for (int i = 0; i < N - pass; i++)
                {
                    if (list[i] > list[i + 1])          //if out of order
                    {
                        Swap (list, i, i + 1);          //exchange
                        sorted = false;                 //found something out of order
                    }
                }

            }

        }
        private static void Swap (List<int> list, int n, int m)
        {
            int temp = list[n];
            list[n] = list[m];
            list[m] = temp;
        }
        /// <summary>
        /// Selection sort method
        /// </summary>
        /// <param name="list">list of integers</param>
        /// <param name="n"></param>
        private static void SelectionSort (List<int> list, int n)
        {
            if (n <= 1)
                return;

            int max = Max (list, n);        //find the max value in the list
            if (list[max] != list[n - 1])
            {
                Swap (list, max, n - 1);          //swap values

            }
            SelectionSort (list, n - 1);          //repeat with n-1
        }                                           
        /// <summary>
        /// Finds the max value in a list
        /// </summary>
        /// <param name="list">list of integers</param>
        /// <param name="n">integer to compare</param>
        /// <returns></returns>
        private static int Max (List<int> list, int n)
        {
            int max = 0;

            for (int i = 0; i < n; i++)
            {
                if (list[max] < list[i])
                {
                    max = i;
                }
            }
            return max;
        }
        /// <summary>
        /// Insertion Sort finds location for next value and inserts it into the list
        /// </summary>
        /// <param name="list">list of integers</param>
        private static void InsertionSort (List<int> list)
        {
            int temp, j;
            int N = list.Count ( );

            for (int i = 1; i < N; i++)
            {
                temp = list[i];                                           //value to be inserted

                for (j = i; j > 0 && temp < list[j - 1]; j--)             //find location of value to be inserted
                {
                    list[j] = list[j - 1];                                //Move items down to make room for it
                }
                list[j] = temp;                                          //insert new value
            }

        }
        /// <summary>
        /// Sorts list of integers using Merge Sort
        /// </summary>
        /// <param name="list">list of Integers</param>
        /// <returns>returns new list</returns>
        private static List<int> MergeSort (List<int> list)
        {
            if (list.Count <= 1)  //if there is only one item in list
                return list;

            List<int> result = new List<int> ( );
            List<int> left = new List<int> ( );
            List<int> right = new List<int> ( );

            //Create left and right sublists of half the size of list
            int middle = list.Count / 2;
            for (int i = 0; i < middle; i++)
            {
                left.Add (list[i]);
            }
            for (int i = middle; i < list.Count; i++)
            {
                right.Add (list[i]);
            }

            //recursively apply mergesort to each side
            left = MergeSort (left);
            right = MergeSort (right);

            //if all in right >= all in left, append right at end of left
            if (left[left.Count - 1] <= right[0])
            {
                return append (left, right);
            }

            //now merge the two,maintaining sorted order
            result = merge (left, right);
            return result;
        }
        /// <summary>
        /// Merges left and right sides of list
        /// </summary>
        /// <param name="left">left portion of list</param>
        /// <param name="right">right portion of list</param>
        /// <returns>new list</returns>
        private static List<int> merge (List<int> left, List<int> right)
        {
            List<int> result = new List<int> ( );

            //Add smaller of tops of two list to result as long as both lists contain more values
            while (left.Count > 0 && right.Count > 0)
            {
                if (left[0] < right[0])
                {
                    result.Add (left[0]);
                    left.RemoveAt (0);
                }
                else
                {
                    result.Add (right[0]);
                    right.RemoveAt (0); //discard
                }
            }

            //One of the two sublists is now empty.
            //Add rest of left, if any

            while (left.Count > 0)
            {
                result.Add (left[0]);
                left.RemoveAt (0);
            }

            //Add rest of right if any
            while (right.Count > 0)
            {
                result.Add (right[0]);
                right.RemoveAt (0);
            }
            return result;
        }
        /// <summary>
        /// Updates list with values of new list
        /// </summary>
        /// <param name="left">left part of list</param>
        /// <param name="right">right part of list</param>
        /// <returns></returns>
        private static List<int> append (List<int> left, List<int> right)
        {
            List<int> result = new List<int> (left);
            foreach (int x in right)
                result.Add (x);
            return result;
        }
        /// <summary>
        /// Calls the QuickSort method and gives it parameters
        /// </summary>
        /// <param name="list">list of integers</param>
        private static void OriginalQuickSort (List<int> list)
        {
            Quicksort (list, 0, list.Count - 1);
        }
        /// <summary>
        /// QuickSort Method. Sorts from two sides of list
        /// </summary>
        /// <param name="list">list of ints</param>
        /// <param name="start">where to begin in list</param>
        /// <param name="end">where to end</param>
        private static void Quicksort (List<int> list, int start, int end)
        {
            int left = start;
            int right = end;

            if (left >= right)
            {
                return;
            }
            //partition into left and right subsets
            while (left < right)
            {
                while (list[left] <= list[right] && left < right)
                {
                    right--;            //burn candle from right
                }
                if (left < right)       //exchange if needed
                {
                    Swap (list, left, right);
                }
                while (list[left] <= list[right] && left < right)
                {
                    left++;             //burn candle from left
                }
                if (left < right)       //exchange if needed
                {
                    Swap (list, left, right);
                }
                Quicksort (list, start, left - 1);   //Recursively sort left partition
                Quicksort (list, right + 1, end);    //Recursively sort right partition
            }
        }
        /// <summary>
        /// Calls QuickMedOfThreeSort method. Passes it appropriate params
        /// </summary>
        /// <param name="list">list of integers</param>
        private static void QuickMedianOfThreeSort (List<int> list)
        {
            QuickMedOfThreeSort (list, 0, list.Count - 1);
        }
        /// <summary>
        /// QuickSort using a median of 3
        /// </summary>
        /// <param name="list">list of ints</param>
        /// <param name="start">start of list</param>
        /// <param name="end">end of list</param>
        private static void QuickMedOfThreeSort (List<int> list, int start, int end)
        {
            const int cutoff = 10;              //point at which we switch to InsertionSort

            if (start + cutoff > end)
            {
                InsertSort (list, start, end);
            }
            else
            {
                int middle = (start + end) / 2;         //find the median of three for pivot
                if (list[middle] < list[start])         //by sorting them and pivot is
                    Swap (list, start, middle);         //in the middle position
                if (list[end] < list[start])
                    Swap (list, start, end);
                if (list[end] < list[middle])
                    Swap (list, middle, end);

                //Place pivot at Position (end-1) since we know that list[end] >= list[middle]
                int pivot = list[middle];
                Swap (list, middle, end - 1);

                //begin partitioning
                int left, right;
                for (left = start, right = end - 1; ;)
                {
                    while (list[++left] < pivot)
                        ;
                    while (pivot < list[--right])
                        ;
                    if (left < right)
                        Swap (list, left, right);
                    else
                        break;
                }
                //restore pivot
                Swap (list, left, end - 1);

                QuickMedOfThreeSort (list, start, left - 1);        //recursively sort left subset
                QuickMedOfThreeSort (list, left + 1, end);          //recusively sort right subset
            }
        }
        /// <summary>
        /// Sorts using insertion
        /// </summary>
        /// <param name="list">list of integers</param>
        /// <param name="start">start of list</param>
        /// <param name="end">end of list</param>
        private static void InsertSort (List<int> list, int start, int end)
        {
            int temp, j;    //temp for holding integer temporarily, j for position counter
            //loop through and switch numbers that are out of order
            for (int i = start + 1; i <= end; i++)
            {
                temp = list[i];
                for (j = i; j > start && temp < list[j - 1]; j--)
                {
                    list[j] = list[j - 1];
                }
                list[j] = temp;
            }
        }
        /// <summary>
        /// Sorts integers in list using shell sort method
        /// </summary>
        /// <param name="list">list of integers</param>
        private static void ShellSort (List<int> list)
        {
            int N = list.Count ( );     //N is the number of contents in the list
            for (int gap = N / 2; gap > 0; gap = (gap == 2 ? 1 : (int)(gap / 2.2)))
            {
                //sort a subset by insertion
                int temp, j;
                for (int i = gap; i < N; i++)
                {
                    temp = list[i];

                    for (j = i; j >= gap && temp < list[j - gap]; j -= gap)
                    {
                        list[j] = list[j - gap];
                    }
                    list[j] = temp;
                }
            }
        }



    }
}
